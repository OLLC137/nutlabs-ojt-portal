<?php

namespace App\Models\Public;

use App\Models\OjtCompanyFile;
use App\Models\OjtContactPerson;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OjtCompany extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'co_name',
        'co_address',
        'co_contact_number',
        'co_email',
        'co_website',
        'co_isactive',
    ];

    public function jobListing()
    {
        return $this->hasMany(OjtJobListing::class, 'id');
    }

    public function contactPerson()
    {
        return $this->hasMany(OjtContactPerson::class, 'id');
    }
    public function companyFile()
    {
        return $this->hasMany(OjtCompanyFile::class,'id');
    }
}
