<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class OjtStudent extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'user_id',
        'stud_prefix',
        'stud_first_name',
        'stud_middle_initial',
        'stud_last_name',
        'stud_suffix',
        'stud_sex',
        'stud_birthday',
        'stud_birth_place',
        'stud_student_telephone',
        'stud_email',
        'stud_junior_high_school',
        'stud_senior_high_school',
        'stud_university',
        'stud_year_level',
        'stud_sr_code',
        'stud_department',
        'stud_expected_graduation',
    ];

    public $timestamps = false;

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function ojtrequirements(): HasMany
    {
        return $this->hasMany(OjtRequirement::class);
    }

    public function ojtaccomplishments(): HasMany
    {
        return $this->hasMany(OjtAccomplishment::class);
    }
    public function journaleditrequest(): HasMany
    {
        return $this->hasMany(JournalEditRequest::class);
    }
      // Student.php
    public function applicants()
    {
        return $this->hasMany(OjtApplicant::class, 'student_id');
    }
    public function scopeByDepartment($query, $department)
    {
    return $query->where('stud_department', $department);
    }


}
