<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruko extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'ruko';
    protected $primaryKey = 'ruko_id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'name',
        'address',
        'price',
        'status',
        'photos',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'photos' => 'array',
        ];
    }
}
