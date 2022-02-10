<?php
  
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
   
class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'details',
    ];


    public static function createOrUpdate($data, $id=null)
    {
        if(!$data['product_id'])
        {
            self::create(request()->except('product_id'));
        }else{
            self::find($data['product_id'])->update(request()->except('product_id'));
        }
        return true;
    }
}