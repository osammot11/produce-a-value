<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResourceLead extends Model
{
    protected $fillable = [
        'name',
        'email',
        'business_type',
    ];
}
