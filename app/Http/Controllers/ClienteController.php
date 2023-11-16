<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

/**
 * Class ClienteController
 * @package App\Http\Controllers
 */

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index() /* Este método muestra una lista paginada de clientes. Utiliza el modelo Cliente para obtener
                            todos los clientes, paginados. Luego, carga la vista 'cliente.index' y pasa los clientes a la vista
                            junto con un contador $i que se utiliza para numerar los elementos en la paginación.*/
    {
        $clientes = Cliente::paginate();

        return view('cliente.index', compact('clientes'))
            ->with('i', (request()->input('page', 1) - 1) * $clientes->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()/*Este método muestra el formulario para crear un nuevo cliente.
                                Crea una nueva instancia del modelo Cliente y carga la vista 'cliente.create',
                                pasando la instancia del cliente a la vista. */
    {
        $cliente = new Cliente();
        return view('cliente.create', compact('cliente'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)/*  Este método almacena un nuevo cliente en la base de datos.
                                                Primero, valida la solicitud según las reglas definidas en el modelo Cliente.
                                                Luego, crea un nuevo cliente usando los datos de la solicitud y redirige a la ruta
                                                'clientes.index' con un mensaje de éxito.*/
    {
        request()->validate(Cliente::$rules);

        $cliente = Cliente::create($request->all());

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)/*Este método muestra los detalles de un cliente específico. Busca el cliente con el
                            ID proporcionado utilizando el modelo Cliente y luego carga la vista 'cliente.show', pasando
                            el cliente a la vista. */
    {
        $cliente = Cliente::find($id);

        return view('cliente.show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)/* Este método muestra el formulario de edición para un cliente existente.
                                Busca el cliente con el ID proporcionado y carga la vista 'cliente.edit',
                                pasando el cliente a la vista.*/
    {
        $cliente = Cliente::find($id);

        return view('cliente.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Cliente $cliente
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, Cliente $cliente)/* Este método actualiza un cliente existente en la base de datos.
                                                            Primero, valida la solicitud según las reglas definidas en el modelo Cliente. Luego,
                                                            actualiza el cliente con los datos de la solicitud y redirige a la ruta 'clientes.index' con un mensaje de éxito.*/
    {
        request()->validate(Cliente::$rules);

        $cliente->update($request->all());

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */

    public function destroy($id)/* Este método elimina un cliente específico de la base de datos. Busca el cliente con el ID
                                    proporcionado, lo elimina y luego redirige a la ruta 'clientes.index' con un mensaje de éxito. */
    {
        $cliente = Cliente::find($id)->delete();

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente deleted successfully');
    }
}
