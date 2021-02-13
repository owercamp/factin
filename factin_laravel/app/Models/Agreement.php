<?php

namespace App\Models;

use App\Models\Lead;
use App\Models\Location;
use App\Models\Municipalities;
use Illuminate\Database\Eloquent\Model;

class Agreement extends Model
{
    protected $table = 'agreements';

    protected $primaryKey = 'legal_id';

    protected $guarded = [];

    public $timestamps = \true;

    public function lead()
    {
        return $this->belongsTo(Lead::class, 'lead_id');
    }

    public function departament()
    {
        return $this->belongsTo(Location::class, 'depid');
    }

    public function municipality()
    {
        return $this->belongsTo(Municipalities::class, 'munid');
    }
}
