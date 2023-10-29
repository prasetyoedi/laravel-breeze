<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'buku';
    protected $primaryKey = 'id';
    
    protected $dates = ['tgl_terbit'];
    protected $fillable = ['judul', 'penulis', 'harga', 'tgl_terbit'];  
}