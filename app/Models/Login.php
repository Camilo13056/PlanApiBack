<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Login extends Model
{
    protected $table = 'usuarios';
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'password_app'
    ];

    protected $hidden = [
        'password',
        'emember_token',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}