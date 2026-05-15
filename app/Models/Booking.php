<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory, HasUuids;

    protected $primaryKey = 'booking_id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'ruko_id',
        'duration_months',
        'usage_plan',
        'ktp_proof',
        'transfer_proof',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function ruko()
    {
        return $this->belongsTo(Ruko::class, 'ruko_id', 'ruko_id');
    }
}
