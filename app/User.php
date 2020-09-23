<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;


class User extends Authenticatable
{
    use Notifiable;
   
    protected $fillable = [
        'name', 'email', 'password', 'cedula', 'address', 'role'
    ];
 
    protected $hidden = [
            'password', 
            'remember_token', 
            'pivot',
            'email_verified_at',
            'created_at',
            'updated_at'
    ];

    public static $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];

    public static function createUsuario(array $data)
    {
        return self::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'usuario'
        ]);


    }    


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeUsuarios($query)
    {
        return $query->where('role','usuario');
    }

    public function scopeInstructores($query)
    {
        return $query->where('role','instructor');
    }

    public function asUsuarioAppointments()
    {
        return $this->hasMany(Appointment::class, 'user_id');
    }

    public function sendFCM($message)
    {
        if(!$this->davide_token)
            return;

        return fcm()->to([
                $this->device_token
            ]) // array
            ->priority('high')
            ->timeToLive(0)
            ->notification([
                'title' => config('app.name'),
                'body' => $message
            ])->send();


    }

}
