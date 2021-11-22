<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table = 'orders';
    
    protected $fillable=["email","quantity","product_id"];

    public function product() {
        return $this->belongsTo(Product::class);}
    
}
