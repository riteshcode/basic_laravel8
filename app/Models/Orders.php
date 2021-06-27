<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Orders extends Model
{
    use HasFactory,Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'order_id','user_id',
        'total_amount',
        'total_quantity','discount',
        'transaction_id','payment_name','payment_type',
        'payment_status','order_status','shipping_status'
    ];





}
