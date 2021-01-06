<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeService extends Model
{
    protected $table = 'type_services';

    protected $primaryKey = 'ts_id';

    protected $fillable = [
        'ts_name'
    ];

    public $timestamps = true;
}
