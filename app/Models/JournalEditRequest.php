<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JournalEditRequest extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'student_id',
        'requested_date',
        'reason',
        'status',
        'acc_accomplishments',
        'acc_hours'
    ];

    public $timestamps = "true";

    public function student(): BelongsTo
    {
        return $this->belongsTo(OjtStudent::class);
    }
}
