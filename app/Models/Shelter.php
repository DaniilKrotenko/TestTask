<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shelter extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'address',
    ];

    public function cats()
    {
        return $this->hasMany(Cat::class);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
