<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'date_start',
        'date_end',
        'price',
        'tenant_id',
        'box_id',
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

    public function box()
    {
        return $this->belongsTo(Box::class, 'box_id');
    }
}
