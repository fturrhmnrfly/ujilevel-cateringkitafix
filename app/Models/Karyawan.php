<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $table = 'karyawan';

    protected $fillable = [
        'nama_karyawan',
        'username_karyawan',
        'posisi',
        'kontak',
        'tanggal_bergabung',
        'status',
        'keahlian', // ✅ GUNAKAN FIELD INI UNTUK MENYIMPAN EMAIL ✅
    ];

    // ✅ VIRTUAL ATTRIBUTES UNTUK FORM ✅
    
    /**
     * Get email attribute - extract dari field keahlian
     */
    public function getEmailAttribute()
    {
        // ✅ EXTRACT EMAIL DARI FIELD KEAHLIAN ✅
        if (!empty($this->keahlian) && strpos($this->keahlian, ' | Email: ') !== false) {
            $parts = explode(' | Email: ', $this->keahlian);
            return $parts[1] ?? $this->generateDefaultEmail();
        }
        
        // ✅ FALLBACK: GENERATE EMAIL OTOMATIS ✅
        return $this->generateDefaultEmail();
    }

    /**
     * Get keahlian_only attribute - keahlian tanpa email
     */
    public function getKeahlianOnlyAttribute()
    {
        if (!empty($this->keahlian) && strpos($this->keahlian, ' | Email: ') !== false) {
            $parts = explode(' | Email: ', $this->keahlian);
            return $parts[0] ?? $this->keahlian;
        }
        
        return $this->keahlian;
    }

    /**
     * Generate default email from nama_karyawan
     */
    private function generateDefaultEmail()
    {
        return strtolower(str_replace(' ', '.', $this->nama_karyawan)) . '@cateringkita.com';
    }

    /**
     * Get tipe_pengguna attribute (virtual - map dari posisi)
     */
    public function getTipePenggunaAttribute()
    {
        $posisiMapping = [
            'Administrator' => 'admin',
            'Staff Operasional' => 'karyawan',
            'Customer Service' => 'user'
        ];

        foreach ($posisiMapping as $posisi => $tipe) {
            if (strpos($this->posisi, $posisi) !== false) {
                return $tipe;
            }
        }

        return 'user'; // default
    }

    /**
     * Set tipe_pengguna attribute (tidak disimpan ke database)
     */
    public function setTipePenggunaAttribute($value)
    {
        // Tipe pengguna tidak disimpan ke database, hanya untuk form handling
    }

    // ✅ SCOPE UNTUK FILTERING ✅
    public function scopeByTipe($query, $tipe)
    {
        $posisiMapping = [
            'admin' => 'Administrator',
            'karyawan' => 'Staff Operasional',
            'user' => 'Customer Service'
        ];

        if (isset($posisiMapping[$tipe])) {
            return $query->where('posisi', 'like', '%' . $posisiMapping[$tipe] . '%');
        }

        return $query;
    }
}
