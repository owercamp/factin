<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $table = 'portfolios';

    protected $primaryKey = 'por_id';

    protected $fillable = [
        'cpro_id',
        'price',
        'created_at',
        'updated_at'
    ];

    public $timestamps = true;

    public function configproduct()
    {
        return $this->belongsTo(ProductConfig::class, 'pc_id');
    }
}
