<?php

namespace App\Models;

use App\Models\StokModel;
use App\Models\KategoriModel;
use App\Models\TransaksiDetailModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BarangModel extends Model
{
    protected $table = 'm_barang';
    protected $primaryKey = 'barang_id';

    protected $fillable = ['kategori_id', 'barang_kode', 'barang_nama', 'harga_beli', 'harga_jual'];

    public function kategori(): BelongsTo {
        return $this->belongsTo(KategoriModel::class, 'kategori_id', 'kategori_id');
    }

    public function stok(): HasOne {
        return $this->hasOne(StokModel::class, 'barang_id', 'barang_id');
    }

    public function detail(): HasMany {
        return $this->hasMany(TransaksiDetailModel::class, 'barang_id', 'barang_id');
    }
}
