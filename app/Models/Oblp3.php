<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oblp3 extends Model
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
        return Oblp3::orderBy('id', 'desc')->get();
    }
}
