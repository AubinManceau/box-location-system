<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'contract_month_time',
        'contract_date',
        'tenant_id',
        'contract_model_id',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'tenant_id');
    }

    public function contractModel()
    {
        return $this->belongsTo(ContractModel::class, 'contract_model_id');
    }

    public function boxes()
    {
        return $this->hasMany(Box::class);
    }
}
