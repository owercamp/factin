<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRating extends Model
{
    protected $table = 'user_ratings';

    protected $primaryKey = 'ur_id';

    protected $guarded = [];

    public $timestamps = true;

    public function follow()
    {
        return $this->belongsTo(Following::class, 'foll_id');
    }
}
