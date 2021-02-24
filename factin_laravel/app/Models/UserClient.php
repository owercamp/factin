<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserClient extends Model
{
    protected $table = 'user_clients';

    protected $primaryKey = 'id';

    protected $guarded = [];

    public $timestamps = true;

    public function contract()
    {
        return $this->belongsTo(Contract::class, 'con_id');
    }
}
