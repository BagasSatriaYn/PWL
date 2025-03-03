<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model // Mendefinisikan model Item
{
    use HasFactory; // Menggunakan HasFactory untuk fitur factory model

    protected $fillable = [ // Atribut yang dapat diisi secara massal
        'name', // Kolom name
        'description', // Kolom description
    ];
}
