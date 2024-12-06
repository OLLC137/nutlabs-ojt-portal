<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OjtDownloadable extends Model
{
    use HasFactory;
    protected $fillable = [
        'file_path',
        'file_name',
        'file_original_name',
        'file_type',
        'file_url'
    ];
}
