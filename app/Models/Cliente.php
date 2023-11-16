<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model; //USO DE CLASES

/**
 * Class Cliente
 *
 * @property $id
 * @property $name
 * @property $email
 * @property $created_at
 * @property $updated_at
 *
 * @property Pedido[] $pedidos //RELACIONADA CON LA CLASE PEDIDO
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Cliente extends Model //DEFINIMOS UN ARRAY ESTATICO CON LAS REGLAS DE VALIDACION PARA CREAR O ACTUALIZAR UN CLIENTE
{
    
    static $rules = [
		'name' => 'required',
		'email' => 'required',
    ];

    protected $perPage = 20; //NUMERO DE ELEMENTOS QUE VEREMOS EN CADA PAGINA MAXIMO

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */


    protected $fillable = ['name','email'];//ATRIBUTOS QUE PODREMOS ASIGNAR EN MASA PARA UN CREATE O UPTADE POR EJEMPLO


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pedidos()
    {
        return $this->hasMany('App\Models\Pedido', 'cliente_id', 'id'); //RELACIONAMOS LA CLASE CLIENTES CON LA DE PEDIDOS, CLIENTE PUEDE TENER VARIOS PEDIDOS Y CLAVE FORANEA DE PEIDOS ES CLIENTE_ID
    }
    

}
