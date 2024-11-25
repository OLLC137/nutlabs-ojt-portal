<?php

namespace App\Models;

use App\Models\OjtJobListing;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OjtJobListCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_list',
        'cat_name',
        'cat_icon',
    ];

    public function joblistings()
    {
        return $this->hasMany(OjtJobListing::class, 'company_id');
    }
}
