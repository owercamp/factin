<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $table = 'requests';

    protected $primaryKey = 'req_id';

    protected $guarded = [];

    public $timestamps = true;

    public function user_client()
    {
        return $this->belongsTo(UserClient::class, 'id');
    }

    public function collaborator()
    {
        return $this->belongsTo(Collaborator::class, 'id');
    }
}
