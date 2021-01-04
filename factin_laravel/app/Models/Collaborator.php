<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collaborator extends Model
{
    protected $table = 'collaborators';

    protected $primaryKey = 'id';

    protected $fillable = [
        'col_name',
        'col_ide',
        'col_dep',
        'col_mun',
        'col_adr',
        'col_ph1',
        'col_ph2',
        'col_ema',
        'col_pho',
        'col_fir'
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
