<?php

namespace App\Models;

use App\Models\Agreement;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $table = 'contracts';

    protected $primaryKey = 'con_id';

    protected $guarded = [];

    public $timestamps = true;

    public function legal()
    {
        return $this->belongsTo(Agreement::class, 'legal_id');
    }
}
