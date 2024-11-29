<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OjtApplicant extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'joblist_id',
        'application_date',
        'resume_mode',
        'resume_file_id',
        'cover_mode',
        'cover_file_id',
        'cover_text'
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(OjtStudent::class, 'student_id', 'id');
    }

}
