<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    protected $table = 'house';
    public $timestamps = false;

    public function accesses()
    {
        return $this->hasMany(Access::class, 'house_id');
    }
}
