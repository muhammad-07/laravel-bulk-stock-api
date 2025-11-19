<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stock extends Model
{
    use HasFactory;
    protected $fillable = [
        'item_code',
        'item_name',
        'quantity',
        'location',
        'store_id',
        'in_stock_date',
        'status',
        'created_by'
    ];
    protected $casts = ['in_stock_date' => 'date'];
    public function store() { 
        return $this->belongsTo(Store::class);
    }
}
