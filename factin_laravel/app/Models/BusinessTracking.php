<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessTracking extends Model
{
    protected $table = 'business_trackings';

    protected $primaryKey = 'bt_id';

    protected $fillable = [
        'bt_date',
        'bt_social',
        'bt_dep',
        'bt_mun',
        'bt_adr',
        'bt_con',
        'bt_pho',
        'bt_What',
        'bt_ema',
        'bt_Obs',
        'bt_status'
    ];

    public $timestamps = true;

    public function departament()
    {
        $this->belongsTo(Location::class, 'depid');
    }

    public function municipality()
    {
        $this->belongsTo(Municipalities::class, 'munid');
    }
}
