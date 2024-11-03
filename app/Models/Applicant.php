<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Applicant extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'application_date', 'status'];
    protected $attributes = [
        'status' => 0, // Default status to 0 for all new applicants
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(OjtStudent::class, 'student_id', 'id');
    }
}
