<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Pedido
 *
 * @property $id
 * @property $precio
 * @property $cliente_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Cliente $cliente
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */

class Pedido extends Model //UN ARRAY ESTATICO CON LAS REGLAS DE QUE PRECIO Y CLIENTE ID SON OBLIGATORIAS
{
    
    static $rules = [
		'precio' => 'required',
		'cliente_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */

    protected $fillable = ['precio','cliente_id'];//ATRIBUTOS QUE SE PUEDEN ASIGANR EN MASA


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */

    public function cliente()
    {
        return $this->hasOne('App\Models\Cliente', 'id', 'cliente_id');//RELACION DE UN PEDIDO QUE PERTENECE A UN CLIENTE, CLAVE FORANEA 
                                                                        //DE LA TABLA ES CLIENTE_ID Y LA CLAVE PRINCIPAL DE LA TABLA CLIENES ES ID
    }
    

}
