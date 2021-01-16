<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hardware extends Model
{
    protected $table = 'hardware';

    protected $primaryKey = 'har_id';

    protected $fillable = [
        'cpro_id',
        'harprice',
        'created_at',
        'updated_at'
    ];

    public $timestamps = true;

    public function configproduct()
    {
        return $this->belongsTo(ProductConfig::class, 'pc_id');
    }
}
