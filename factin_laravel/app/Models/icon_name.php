<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class icon_name extends Model
{
    protected $table = 'icon_names';

    protected $primaryKey = 'icon_id';

    protected $fillable = [
        'icon_name'
    ];

    public $timestamps = true;
}
