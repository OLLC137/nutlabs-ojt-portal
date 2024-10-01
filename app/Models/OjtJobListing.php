<?php

namespace App\Models;

use App\Models\OjtContactPerson;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OjtJobListing extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'company_id',
        'job_ref',
        'job_list',
        'job_desc',
        'job_category',
        'job_status',
    ];

    public function company()
    {
        return $this->belongsTo(OjtCompany::class, 'company_id');
    }
    public function contactPerson()
    {
        return $this->hasOne(OjtContactPerson::class, 'job_person');
    }
}
