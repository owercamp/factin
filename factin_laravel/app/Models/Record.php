<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $table = 'records';

    protected $primaryKey = 'rec_id';

    protected $guarded = [];

    public $timestamps = true;
}
