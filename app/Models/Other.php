<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Other extends Model
{

    use SoftDeletes;

    protected $fillable = [
        'how_works',
        'this_for',
        'this_not_for',
        'updated_by',
        'deleted_by',
    ];

    public function tech()
    {
        return $this->hasMany(Tech::class);
    }

    public function solution()
    {
        return $this->hasMany(Solution::class);
    }
}
