<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'locations';

    protected $primaryKey = 'depid';
    
    protected $fillable =[
        'depname',
        'created_at',
        'updated_at'
    ];
    
    public $timestamps = true;

    public function municipalities()
    {
        return $this->belongsTo(Municipalities::class, 'munid');
    }

    public function collaborator()
    {
        return $this->belongsTo(Collaborator::class, 'id');
    }

}
