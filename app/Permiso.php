<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    //
    protected $table = "permisos"; //@.- Nombre de la tabla
    protected $primaryKey = 'id_permiso'; //@.- Identificador de la tabla
    public $timestamps = false; //@.- Campos de fecha desactivados
    protected $fillable = [  //@.- Nombres campos de la tabla
    'per_fecha_registro',
    'id_users'
    ];

    protected $attributes = [ //@.- Nombres campos por default
        'per_estado' => 1
    ];
}
