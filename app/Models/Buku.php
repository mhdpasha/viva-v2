<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Buku extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class);
    }

    public function detail(): HasMany
    {
        return $this->hasMany(DetailBuku::class);
    }

    public function pinjam(): HasMany
    {
        return $this->hasMany(Peminjaman::class);
    }

}
