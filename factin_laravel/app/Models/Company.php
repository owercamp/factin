<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies';

    protected $primaryKey = 'comid';

    protected $fillable = [
        'comsocial',
        'comnit',
        'comdepid',
        'communid',
        'comaddress',
        'comphone1',
        'comphone2',
        'comemail'
    ];

    public $timestamps = true;

    public function departament()
    {
        return $this->belongsTo(Location::class, 'depid');
    }

    public function municipality()
    {
        return $this->belongsTo(Municipalities::class, 'munid');
    }
}
