<?php
  
namespace App\Models;
  
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
  
class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'roles',
    ];
  
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
  
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function createOrUpdate($data, $id=null)
    {
        if(!$data['user_id'])
        {
            self::create(request()->except('user_id'));
        }else{
            self::find($data['user_id'])->update(request()->except('user_id'));
        }
        return true;
    }
}

  
// namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
   
// class User extends Model
// {
//     use HasFactory;
//     protected $fillable = [
//         'name',
//         'email',
//         'password',
//     ];


//     public static function createOrUpdate($data, $id=null)
//     {
//         if(!$data['user_id'])
//         {
//             self::create(request()->except('user_id'));
//         }else{
//             self::find($data['user_id'])->update(request()->except('user_id'));
//         }
//         return true;
//     }
// }