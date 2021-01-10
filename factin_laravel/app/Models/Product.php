<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $primaryKey = 'pro_id';

    protected $fillable = [
        'pro_name'
    ];

    public $timestamps = true;
    
    public function configpro()
    {
        return $this->belongsTo(ProductConfig::class, 'pc_id');
    }
}
