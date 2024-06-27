<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Usuario extends Model
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
        'remember_token',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function setPasswordAppAttribute($value)
    {
        $this->attributes['password_app'] = Hash::make($value);
    }
}
