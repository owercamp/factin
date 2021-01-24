<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teken extends Model
{
    protected $table = 'tekens';

    protected $primaryKey = 'tk_id';

    protected $fillable = [
        'tk_date',
        'tk_social',
        'tk_teken'
    ];

    public $timestamps = true;

    public function business_trackings()
    {
        return $this->belongsTo(BusinessTracking::class, 'bt_id');
    }
}
