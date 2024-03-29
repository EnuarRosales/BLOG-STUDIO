<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;


    // protected $attributes = [
    //     'name' => 'Enuar Emilio Rosales Salazar',
    //     'cedula' => '108613644',
    //     'celular' => '3057465217',
    //     'direccion' => 'Sandona centenario',
    //     'email' => 'admin100@gmail.com',
    //     'tipoUsuario_id' => 1
    // ];



    //CON ESTO LOGRAMOS HACER LA ASIGNACION MASIVA
    protected $guarded = [];
    // protected $appends = ['empresa_id'];


    //ACCESOR
    public function getNameAttribute($value)
    {
        return ucwords($value);
    }

    //MUTADOR
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtolower($value);
    }

    //RELACION UNO A MUCHOS INVERSA
    public function tipoUsuario()
    {
        return $this->belongsTo('App\Models\TipoUsuario', 'tipoUsuario_id');
    }

    //RELACION UNO A MUCHOS INVERSA
    public function empresa()
    {
        return $this->belongsTo('App\Models\Empresa', 'empresa_id');
    }

    public static function getPermissionIds(User $user)
    {
        $userLogueado = $user->id;
        // Obtén los IDs de los permisos relacionados con los roles del usuario
        $rol = ModelHasRoles::where('model_id', $userLogueado)->pluck('role_id')->toArray();
        $rol = array_unique($rol);

        return RoleHasPermission::whereIn('role_id', $rol)->pluck('permission_id')->toArray();
    }


    // public function tipoUsuario()
    // {
    //     return $this->belongsTo(TipoUsuario::class,'tipoUsuario_id');
    // }






    //RELACION UNO A MUCHOS
    public function asignacionRooms()
    {
        return $this->hasMany('App\Models\AsignacionRoom');
    }

    //RELACION DE UNO A MUCHOS
    public function asignacionTurnos()
    {
        return $this->hasMany('App\Models\AsignacionTurno');
    }

    //RELACION DE UNO A MUCHOS
    public function asignacionMultas()
    {
        return $this->hasMany('App\Models\AsignacionMulta');
    }

    //RELACION DE UNO A MUCHOS
    public function asistencias()
    {
        return $this->hasMany('App\Models\Asistencia');
    }

    //RELACION DE UNO A MUCHOS
    public function registroProducidos()
    {
        return $this->hasMany('App\Models\RegistroProducido');
    }

    //RELACION DE UNO A MUCHOS
    public function descuentos()
    {
        return $this->hasMany('App\Models\Descuento', 'descuento_id');
    }

    public function empresas()
    {
        return $this->belongsToMany(Empresa::class, 'user_empresa');
    }

    //RELACION DE UNO A MUCHOS
    public function reportePaginas()
    {
        return $this->hasMany('App\Models\ReportePagina');
    }

    //RELACION DE UNO A MUCHOS
    public function pagos()
    {
        return $this->hasMany('App\Models\Pago');
    }

    /*
                    //relacion uno a muchos¿¿
    public function asignacionRooms(){
        return $this->hasMany('App\Models\AsignacionRooms');
    }


    /*
    //relacion uno a muchos (inversa)
    public function tipoUsuario(){
        return $this->hasOne('App\Models\TipoUsuarios');
    }*/
}
