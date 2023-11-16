<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Cliente;
use Illuminate\Http\Request;

/**
 * Class PedidoController
 * @package App\Http\Controllers
 */
class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() /*muestra una lista paginada utiliza el modelo pedido para obtener todos los pedidos.
                            Y cargamos la vista pedido.index y pasa los pedidos a la vista con un contador*/
    {
        $pedidos = Pedido::paginate();

        return view('pedido.index', compact('pedidos'))
            ->with('i', (request()->input('page', 1) - 1) * $pedidos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() /* Metodo para mostrar el formulario para crear un nuevo peidido.Crea una nueva instancia en el modelo Pedido y obtiene una lista
                                de clientes usando el modelo Cliente para llenar  un campo en el formulario.
                                Luego carga la vista 'pedido.create' y pasa la instancia del pedido y la lista de clientes a la vista.*/
    {
        $pedido = new Pedido();
        $clientes = Cliente::pluck('name', 'id');
        return view('pedido.create', compact('pedido', 'clientes'));
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request) /* Este método almacena un nuevo pedido en la base de datos. Primero, valida la solicitud según
                                                las reglas definidas en el modelo Pedido. Luego, crea un nuevo pedido usando los datos de la solicitud
                                                y lo redirige a la ruta 'pedidos.index' con un mensaje de éxito.*/
    {
        request()->validate(Pedido::$rules);

        $pedido = Pedido::create($request->all());

        return redirect()->route('pedidos.index')
            ->with('success', 'Pedido created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function show($id) /* Este método muestra los detalles de un pedido específico. Busca el pedido con el
                                ID proporcionado utilizando el modelo Pedido y luego carga la vista 'pedido.show' y
                                pasa el pedido a la vista.*/
    {
        $pedido = Pedido::find($id);

        return view('pedido.show', compact('pedido'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id) /*Este método muestra el formulario de edición para un pedido existente.
                                Busca el pedido con el ID proporcionado y obtiene una lista de clientes usando el
                                modelo Cliente para llenar un campo de selección en el formulario. Luego carga la vista
                                'pedido.edit' y pasa el pedido y la lista de clientes a la vista.*/
    {
        $pedido = Pedido::find($id);
        $clientes = Cliente::pluck('name', 'id');
    
        return view('pedido.edit', compact('pedido', 'clientes'));
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Pedido $pedido
     * @return \Illuminate\Http\Response
     */


    public function update(Request $request, Pedido $pedido) /* Este método actualiza un pedido existente en la base de datos.
                                                                Primero, valida la solicitud según las reglas definidas en el modelo Pedido. Luego,
                                                                actualiza el pedido con los datos de la solicitud y lo redirige a la ruta 'pedidos.index'
                                                                con un mensaje de éxito.*/
    {
        request()->validate(Pedido::$rules);

        $pedido->update($request->all());

        return redirect()->route('pedidos.index')
            ->with('success', 'Pedido updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */

    public function destroy($id) /*Este método elimina un pedido específico de la base de datos.
                                    Busca el pedido con el ID proporcionado, lo elimina y luego redirige a la ruta
                                    'pedidos.index' con un mensaje de éxito. */
    {
        $pedido = Pedido::find($id)->delete();

        return redirect()->route('pedidos.index')
            ->with('success', 'Pedido deleted successfully');
    }
}
