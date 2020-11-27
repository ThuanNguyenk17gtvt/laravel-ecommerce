<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class user extends Model
{
    protected $table='user';
    protected $primaryKey='name_id';
    protected $keyType = 'string';
    protected $guarded=[];
}
