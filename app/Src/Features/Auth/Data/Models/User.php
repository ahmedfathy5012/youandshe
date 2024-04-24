<?php


namespace Src\Features\Auth\Data\Models;


// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Src\Features\Barber\Data\Models\Review;
use Src\Features\BaseApp\Data\Models\Address;
use Src\Features\Booking\Data\Models\Booking;
use Src\Features\Location\Data\Models\City;
use Src\Features\Location\Data\Models\State;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
        protected $fillable = ['id','name', 'password', 'phone', 'device_id', 'device_token', 'api_token', 'phone_verify', 'gender', 'status', 'image', 'state_id', 'city_id', 'service_gender', 'ready_to_notify', 'activate_code'];


    protected $visible = array('id','name', 'phone', 'device_id', 'device_token', 'api_token', 'phone_verify', 'gender', 'status', 'image', 'state_id', 'city_id', 'service_gender', 'ready_to_notify', 'activate_code');




    /**
     * The attributes that should be hidden for serialization.
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
//        'remember_token',
    ];

//    /**
//     * The attributes that should be cast.
//     *
//     * @var array<string, string>
//     */
//    protected $casts = [
//        'email_verified_at' => 'datetime',
//    ];




    protected $table = 'users';
    public $timestamps = true;

    public function bookings()
    {
        return $this->hasMany(Booking::class,'user_id','id');
    }

    public function addresses()
    {
        return $this->hasMany(Address::class,'user_id');
    }

    public function addressesCheck($id)
    {
//        dd($id);
        $addresses =  $this->addresses;

        $status = false;
        foreach($addresses as $address){
          if($address->id == $id){
              return  true;
          }
        }
        return $status;
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

}
