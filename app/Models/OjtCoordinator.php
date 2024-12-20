<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OjtCoordinator extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'department',
    ];

    /**
     * Define the relationship with the User model.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Define the relationship with OjtStudent model.
     */
    public function students()
    {
        return $this->hasMany(OjtStudent::class, 'stud_department', 'department');
    }
}
