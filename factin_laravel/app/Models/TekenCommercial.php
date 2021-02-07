<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TekenCommercial extends Model
{
    protected $table = 'teken_commercials';

    protected $primaryKey = 'tkc_id';

    protected $guarded = [];

    public $timestamps = true;

    public function business_trackings()
    {
        return $this->belongsTo(BusinessTracking::class, 'bt_id');
    }
}
