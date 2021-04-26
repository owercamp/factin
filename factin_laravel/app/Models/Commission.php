<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    protected $table = 'commissions';

    protected $primaryKey = 'co_id';

    protected $guarded = [];

    public $timestamps = true;

    public function collaborator()
    {
        return $this->belongsTo(Collaborator::class, 'id');
    }
}
