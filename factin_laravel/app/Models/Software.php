<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Software extends Model
{
    protected $table = 'software';

    protected $primaryKey = 'sof_id';

    protected $fillable = [
        'cpro_id',
        'sofprice',
        'created_at',
        'updated_at'
    ];

    public $timestamps = true;

    public function configproduct()
    {
        return $this->belongsTo(ProductConfig::class, 'pc_id');
    }
}
