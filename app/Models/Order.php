<?php
/**
 * Created by IntelliJ IDEA.
 * User: 王得屹
 * Date: 2016/6/12
 * Time: 17:05
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model{
    protected $table = 'orders';

    public $timestamps = false;

    protected  $primaryKey = 'order_id';

    protected  $fillable = [
        'star_id',
        'task_id',
        'status'
    ];
}