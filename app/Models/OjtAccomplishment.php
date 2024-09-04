<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OjtAccomplishment extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'acc_date',
        'acc_accomplishments',
        'acc_hours',
    ];

    public $timestamps = true;

    public function student(): BelongsTo
    {
        return $this->belongsTo(OjtStudent::class);
    }
}
