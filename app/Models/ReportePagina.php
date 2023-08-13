<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportePagina extends Model
{
    use HasFactory;

    //CON ESTO LOGRAMOS HACER LA ASIGNACION MASIVA
    protected $guarded = [];

    

    //RELACION UNO A MUCHOS  INVERSA
    public function user(){
        return $this->belongsTo('App\Models\User','user_id');
    }

    

    //RELACION UNO A MUCHOS  INVERSA
    public function pagina(){
        return $this->belongsTo('App\Models\Pagina','pagina_id');
    } 


 



    

    





}