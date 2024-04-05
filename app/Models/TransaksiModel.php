<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TransaksiModel extends Model
{
   protected $table = 't_penjualan';

   protected $primary_key = 'penjualan_id';

   public function user(): BelongsTo {
        return $this->belongsTo(UserModel::class, 'user_id', 'user_id');
   }

   public function detail(): HasMany {
        return $this->hasMany(TransaksiDetailModel::class, 'penjualan_id', 'penjualan_id');
   }
}
