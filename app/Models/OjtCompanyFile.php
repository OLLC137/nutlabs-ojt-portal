<?php

namespace App\Models;

use App\Models\Public\OjtCompany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OjtCompanyFile extends Model
{
    use HasFactory;
    protected $fillable = [
    'file_path',
    'file_name',
    'file_original_name',
    'file_type',
    'uploaded_by',
    'company_id',
    ];

    public function company()
    {
        return $this->belongsTo(OjtCompany::class, 'company_id');
    }
}
