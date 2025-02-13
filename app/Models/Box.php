<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'description',
        'adress',
        'price',
        'user_id',
        'tenant_id',
    ];

    public function tenant()
    { 
        return $this->belongsTo(Tenant::class, 'tenant_id'); 
    }

    public function user()
    { 
        return $this->belongsTo(User::class, 'user_id'); 
    }
}
