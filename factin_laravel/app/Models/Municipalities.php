<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Municipalities extends Model
{
    protected $table = 'municipalities';

    protected $primaryKey = 'munid';

    protected $fillable = [
        'munname',
        'mundepid',
        'created_at',
        'updated_at'
    ];

    public $timestamps = true;

    public function departament()
    {
        return $this->belongsTo(Location::class, 'depid');
    }

}
