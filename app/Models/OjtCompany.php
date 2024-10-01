<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OjtCompany extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'co_name',
        'co_address',
        'co_contact_number',
        'co_email',
        'co_website',
        'co_isactive',
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}