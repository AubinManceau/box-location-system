<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'firstname',
        'lastname',
        'email',
        'phone',
        'adress',
        'city',
        'zip_code',
        'user_id',
    ];

    public function boxes() 
    { 
        return $this->hasMany(Box::class); 
    }
}
