<?php

namespace App\Models;

use App\Models\OjtCompany;
use App\Models\OjtJobListing;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OjtContactPerson extends Model
{
    use HasFactory;

        protected $fillable = [
        'company_id',
        'contact_name',
        'contact_position',
        'contact_contact',
        'contact_email',
    ];

    public function jobListing()
    {
        return $this->hasMany(OjtJobListing::class, 'id');
    }
    public function company()
    {
        return $this->belongsTo(OjtCompany::class, 'company_id');
    }

}
