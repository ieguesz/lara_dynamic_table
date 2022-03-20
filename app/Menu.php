<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = "clientes"; //@.- Nombre de la tabla
    protected $primaryKey = 'id_menu'; //@.- Identificador de la tabla
    public $timestamps = false; //@.- Campos de fecha desactivados
    protected $fillable = [  //@.- Nombres campos de la tabla
    'mnu_descripcion'
    ];

    protected $attributes = [ //@.- Nombres campos por default
        'mnu_estado' => 1
    ];
}
