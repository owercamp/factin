<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Icon extends Model
{
    protected $table = 'icons';

    protected $primaryKey = 'ico_id';

    protected $fillable = [
        'ico_qr',
        'ico_name'
    ];

    public $timestamps = true;
}
