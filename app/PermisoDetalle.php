<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermisoDetalle extends Model
{
    protected $table = "permiso_detalles"; //@.- Nombre de la tabla
    protected $primaryKey = 'id_permiso_detalle'; //@.- Identificador de la tabla
    public $timestamps = false; //@.- Campos de fecha desactivados
    protected $fillable = [  //@.- Nombres campos de la tabla
    'id_menu',
    'id_permiso'
    ];

    protected $attributes = [ //@.- Nombres campos por default
        'pd_estado' => 1
    ];
}
