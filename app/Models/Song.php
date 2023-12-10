<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'singer',
        'written_by',
        'album_name',
        'album_img',
        'publisher',
        'lyrics',
        'user_id'
    ];
}
