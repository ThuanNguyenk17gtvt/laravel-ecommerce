<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $table='product';
    protected $primaryKey='prod_id';
    protected $keyType = 'string';
    protected $guarded=[];

}
