<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tech extends Model
{

    use SoftDeletes;

    protected $fillable = [
        'other_id',
        'title',
        'url',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
    
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];
}
