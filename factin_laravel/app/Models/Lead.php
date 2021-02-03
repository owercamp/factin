<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $table = 'leads';

    protected $primaryKey = 'lead_id';

    protected $guarded = [];

    public $timestamps = true;

    public function departament()
    {
        return $this->belongsTo(Location::class, 'depid');
    }

    public function municipalities()
    {
        return $this->belongsTo(Municipalities::class, 'munid');
    }

    public function trade()
    {
        return $this->belongsTo(BusinessTracking::class, 'bt_id');
    }

}
