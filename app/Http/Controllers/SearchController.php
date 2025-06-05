<?php

namespace App\Http\Controllers;

use App\Models\KelolaMakanan;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class SearchController extends Controller
{
    /**
     * Search suggestions for navbar autocomplete
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function suggestions(Request $request): JsonResponse
    {
        try {
            $query = $request->input('query', '');
            
            // Validate input
            if (empty($query) || strlen($query) < 2) {
                return response()->json([]);
            }

            // Clean and prepare search query
            $searchTerm = strtolower(trim($query));
            
            // PERBAIKAN: Hanya cari berdasarkan nama_makanan saja
            $results = KelolaMakanan::where('status', 'Tersedia')
                ->where(function($q) use ($searchTerm) {
                    // Prioritas 1: Nama makanan yang dimulai dengan kata kunci
                    $q->whereRaw('LOWER(nama_makanan) LIKE ?', ["{$searchTerm}%"])
                      // Prioritas 2: Nama makanan yang mengandung kata kunci (dengan spasi sebelumnya)
                      ->orWhereRaw('LOWER(nama_makanan) LIKE ?', ["% {$searchTerm}%"])
                      // Prioritas 3: Nama makanan yang mengandung kata kunci di tengah
                      ->orWhereRaw('LOWER(nama_makanan) LIKE ?', ["%{$searchTerm}%"]);
                    // HAPUS: Pencarian di deskripsi dihilangkan
                })
                ->select('id', 'nama_makanan', 'kategori', 'harga', 'image', 'deskripsi')
                ->get();

            // PERBAIKAN: Filtering hanya berdasarkan nama_makanan
            $filteredResults = $results->filter(function($item) use ($searchTerm) {
                $itemName = strtolower($item->nama_makanan);
                
                // Hanya tampilkan hasil yang nama_makanannya mengandung kata kunci
                return str_contains($itemName, $searchTerm);
            });

            // Sort results by relevance dengan scoring berdasarkan nama_makanan saja
            $sortedResults = $filteredResults->sort(function($a, $b) use ($searchTerm) {
                $aName = strtolower($a->nama_makanan);
                $bName = strtolower($b->nama_makanan);
                
                // Scoring system berdasarkan nama_makanan saja
                $aScore = $this->calculateRelevanceScore($aName, $searchTerm);
                $bScore = $this->calculateRelevanceScore($bName, $searchTerm);
                
                return $bScore <=> $aScore; // Sort descending by score
            });

            // Take only top 8 results
            $topResults = $sortedResults->take(8);

            // Transform results
            $suggestions = $topResults->map(function($item) {
                return [
                    'id' => $item->id,
                    'nama_makanan' => $item->nama_makanan,
                    'kategori' => $item->kategori,
                    'harga' => number_format($item->harga, 0, ',', '.'),
                    'image' => $this->getImageUrl($item->image),
                    'url' => $this->getItemUrl($item)
                ];
            });

            // Log search for analytics
            Log::info('Search performed', [
                'query' => $searchTerm,
                'results_count' => $suggestions->count(),
                'top_result' => $suggestions->first()['nama_makanan'] ?? 'No results'
            ]);

            return response()->json($suggestions->values());

        } catch (\Exception $e) {
            Log::error('Search suggestions error: ' . $e->getMessage(), [
                'query' => $request->input('query'),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'error' => 'Terjadi kesalahan saat mencari'
            ], 500);
        }
    }

    /**
     * Calculate relevance score for search results based on nama_makanan only
     * 
     * @param string $name
     * @param string $searchTerm
     * @return int
     */
    private function calculateRelevanceScore(string $name, string $searchTerm): int
    {
        $score = 0;
        
        // Exact match di awal nama (skor tertinggi)
        if (str_starts_with($name, $searchTerm)) {
            $score += 1000;
        }
        
        // Exact match sebagai kata terpisah di nama
        if (preg_match("/\b{$searchTerm}\b/", $name)) {
            $score += 500;
        }
        
        // Contains di nama (dengan spasi sebelumnya)
        if (str_contains($name, " {$searchTerm}")) {
            $score += 300;
        }
        
        // Contains di nama (posisi manapun)
        if (str_contains($name, $searchTerm)) {
            $score += 100;
        }
        
        return $score;
    }

    /**
     * Get proper image URL with fallback
     * 
     * @param string|null $image
     * @return string
     */
    private function getImageUrl(?string $image): string
    {
        if (empty($image)) {
            return asset('assets/default-food.png');
        }

        // Check if image path starts with storage/
        if (str_starts_with($image, 'storage/')) {
            return asset($image);
        }

        // Check if file exists in storage
        $imagePath = 'storage/' . $image;
        if (file_exists(public_path($imagePath))) {
            return asset($imagePath);
        }

        // Fallback to default image
        return asset('assets/default-food.png');
    }

    /**
     * Get item detail URL based on category
     * 
     * @param KelolaMakanan $item
     * @return string
     */
    private function getItemUrl(KelolaMakanan $item): string
    {
        try {
            $kategori = strtolower(trim($item->kategori));
            
            switch ($kategori) {
                case 'prasmanan':
                    return route('menuprasmanan.show', $item->id);
                case 'nasi box':
                    return route('menunasibox.show', $item->id);
                default:
                    // Log untuk debugging kategori yang tidak dikenali
                    Log::info('Unknown category in search', [
                        'item_id' => $item->id,
                        'kategori' => $item->kategori,
                        'nama_makanan' => $item->nama_makanan
                    ]);
                    return route('dashboard');
            }
        } catch (\Exception $e) {
            Log::warning('Failed to generate route for item', [
                'item_id' => $item->id,
                'kategori' => $item->kategori,
                'error' => $e->getMessage()
            ]);
            return route('dashboard');
        }
    }

    /**
     * Advanced search with filters and stricter matching (nama_makanan only)
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function advancedSuggestions(Request $request): JsonResponse
    {
        try {
            $query = $request->input('query', '');
            $kategori = $request->input('kategori', '');
            $minPrice = $request->input('min_price', 0);
            $maxPrice = $request->input('max_price', 0);
            
            if (empty($query) || strlen($query) < 2) {
                return response()->json([]);
            }

            $searchTerm = strtolower(trim($query));
            
            $results = KelolaMakanan::where('status', 'Tersedia')
                ->where(function($q) use ($searchTerm) {
                    // Pencarian hanya berdasarkan nama_makanan
                    $q->whereRaw('LOWER(nama_makanan) LIKE ?', ["{$searchTerm}%"])
                      ->orWhereRaw('LOWER(nama_makanan) LIKE ?', ["% {$searchTerm}%"])
                      ->orWhereRaw('LOWER(nama_makanan) LIKE ?', ["%{$searchTerm}%"]);
                })
                ->when($kategori, function($q) use ($kategori) {
                    return $q->where('kategori', $kategori);
                })
                ->when($minPrice > 0, function($q) use ($minPrice) {
                    return $q->where('harga', '>=', $minPrice);
                })
                ->when($maxPrice > 0, function($q) use ($maxPrice) {
                    return $q->where('harga', '<=', $maxPrice);
                })
                ->select('id', 'nama_makanan', 'kategori', 'harga', 'image', 'deskripsi')
                ->get();

            // Filter hasil untuk memastikan relevansi berdasarkan nama_makanan saja
            $filteredResults = $results->filter(function($item) use ($searchTerm) {
                $itemName = strtolower($item->nama_makanan);
                return str_contains($itemName, $searchTerm);
            });

            $suggestions = $filteredResults->take(8)->map(function($item) {
                return [
                    'id' => $item->id,
                    'nama_makanan' => $item->nama_makanan,
                    'kategori' => $item->kategori,
                    'harga' => number_format($item->harga, 0, ',', '.'),
                    'image' => $this->getImageUrl($item->image),
                    'url' => $this->getItemUrl($item)
                ];
            });

            return response()->json($suggestions->values());

        } catch (\Exception $e) {
            Log::error('Advanced search error: ' . $e->getMessage());
            return response()->json(['error' => 'Terjadi kesalahan saat mencari'], 500);
        }
    }

    /**
     * Full search page with pagination and strict filtering (nama_makanan only)
     * 
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function search(Request $request)
    {
        $query = $request->input('query', '');
        $kategori = $request->input('kategori', '');
        $results = collect();

        if (!empty($query) && strlen($query) >= 2) {
            $searchTerm = strtolower(trim($query));
            
            $results = KelolaMakanan::where('status', 'Tersedia')
                ->where(function($q) use ($searchTerm) {
                    // Pencarian hanya berdasarkan nama_makanan untuk halaman search
                    $q->whereRaw('LOWER(nama_makanan) LIKE ?', ["{$searchTerm}%"])
                      ->orWhereRaw('LOWER(nama_makanan) LIKE ?', ["% {$searchTerm}%"])
                      ->orWhereRaw('LOWER(nama_makanan) LIKE ?', ["%{$searchTerm}%"]);
                })
                ->when($kategori, function($q) use ($kategori) {
                    return $q->where('kategori', $kategori);
                })
                ->orderByRaw("
                    CASE 
                        WHEN LOWER(nama_makanan) LIKE ? THEN 1
                        WHEN LOWER(nama_makanan) LIKE ? THEN 2
                        WHEN LOWER(nama_makanan) LIKE ? THEN 3
                        ELSE 4
                    END
                ", [
                    strtolower($searchTerm) . '%',        // Starts with
                    '% ' . strtolower($searchTerm) . '%', // Word boundary
                    '%' . strtolower($searchTerm) . '%'   // Contains in name
                ])
                ->paginate(12);
        }

        return view('search.results', compact('results', 'query', 'kategori'));
    }
}
