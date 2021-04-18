<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillingOrder extends Model
{
    protected $table = 'billing_orders';

    protected $primaryKey = 'bo_id';

    protected $guarded = [];

    public $timestamps = true;
    
}
