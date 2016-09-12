<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    protected $table = 'house';
    public $timestamps = false;

    public function operations()
    {
        return $this->hasMany(Operation::class, 'house_id');
    }
}
