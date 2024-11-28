<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OjtRequirement extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'student_id',
        'req_id',
        'req_file_name',
        'req_orig_name',
        'req_file_path',
        'locked_at'
    ];

    public $timestamps = false;

    // Define the requirements as constants
    const REQUIREMENTS = [
        // pre ojt requirements
        1 => 'Medical Certificate',
        2 => 'Vaccination Card',
        3 => 'Resume',
        4 => 'Personal History Statement',
        5 => 'Parent Consent Form',
        6 => 'Endorsement Letter',
        7 => 'Training Plan',
        8 => 'MOA',
        9 => 'Internship Agreement',
        10 => 'OJT Acceptance Form',
        // post ojt requirements
        11 => 'OJT Journal',
        12 => 'Student Trainee Feedback Form',
        13 => 'Training Supervisor Feedback Form',
        14 => 'Student Trainee Performance Appraisal Report',
    ];

    // Accessor to get the requirement name
    public function getRequirementNameAttribute()
    {
        return self::REQUIREMENTS[$this->req_id] ?? 'Unknown Requirement';
    }

    public function students(): BelongsTo
    {
        return $this->belongsTo(OjtStudent::class);
    }
}
