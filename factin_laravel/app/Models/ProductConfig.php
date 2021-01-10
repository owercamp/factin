<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductConfig extends Model
{
    protected $table = 'product_configs';

    protected $primaryKey = 'pc_id';

    protected $fillable = [
        'pc_version',
        'pc_typepro',
        'pc_content'
    ];

    public $timestamps = true;

    public function typepro()
    {
        return $this->belongsTo(Product::class, 'pro_id');
    }
}
