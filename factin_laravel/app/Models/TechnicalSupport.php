<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TechnicalSupport extends Model
{
    protected $table = 'technical_supports';

    protected $primaryKey = 'id';

    protected $fillable = [
        'cpro_id',
        'tsprice',
        'created_at',
        'updated_at'
    ];

    public $timestamps = true;

    public function configproduct()
    {
        return $this->belongsTo(ProductConfig::class, 'pc_id');
    }
}
