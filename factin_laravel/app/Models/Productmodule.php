<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Productmodule extends Model
{
    protected $table = 'productmodules';

    protected $primaryKey = 'mod_id';

    protected $fillable = [
        'mod_name'
    ];

    public $timestamps = true;
    
}
