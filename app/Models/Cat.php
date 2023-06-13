<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cat extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'shelter_id',
        'health',
        'arrival',
        'departure',
    ];

    public function shelter()
    {
        return $this->belongsTo(Shelter::class);
    }
}
