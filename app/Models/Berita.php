<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $fillable = [
        "nama_file",
        "dokumen",
        "hash_dokumen",
        "uploader"
    ] ;

    static public function getRecord()
    {
        return Berita::orderBy('id', 'desc')->get();
    }
}
