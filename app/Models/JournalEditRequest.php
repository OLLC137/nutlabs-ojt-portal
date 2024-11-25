<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JournalEditRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'requested_date',
        'reason',
        'status'
    ];
}
