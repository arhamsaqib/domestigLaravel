<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderServices extends Model
{
    use HasFactory;
    protected $casts = [
        'provider_id' => 'string', // Will convarted to (Bool)
        'category_name' => 'string', // Will convarted to (Array)
        'services' => 'array', // Will convarted to (Array)
        'rate' => 'string', // Will convarted to (Array)
        'status' => 'string', // Will convarted to (Array)
    ];
    protected $guarded = [];
}
