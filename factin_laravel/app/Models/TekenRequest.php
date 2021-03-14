<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TekenRequest extends Model
{
    protected $table = 'teken_requests';

    protected $primaryKey = 'tkreq_id';

    protected $guarded = [];

    public $timestamps = true;

    public function follow()
    {
        return $this->belongsTo(Following::class, 'foll_id');
    }
}
