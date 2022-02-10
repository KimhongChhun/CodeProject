<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organ extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'address',
        
    ];


    public static function createOrUpdate($data, $id=null)
    {
        if(!$data['organ_id'])
        {
            self::create(request()->except('organ_id'));
        }else{
            self::find($data['organ_id'])->update(request()->except('organ_id'));
        }
        return true;
    }
}
