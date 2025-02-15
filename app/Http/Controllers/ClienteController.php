<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClienteRequest;
use App\Models\Cliente;
use App\Models\Pais;
use Illuminate\Http\Request;

class ClienteController extends Controller
{

    public function __cosntruct()
    {
        $this->middleware('rol:A')->only('index', 'create', 'store', 'show', 'edit', 'update', 'destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::getClientes();
        return view('cliente.index',
            ['clientes' => $clientes]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $paises = Pais::getPaises();
        return view('cliente.create', [
            'paises' => $paises
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClienteRequest $request)
    {
        $cliente = new Cliente($request->validated());
        $cliente->save();
        return to_route('cliente.show', ['cliente' => $cliente->id]);
        //hola
    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        return view('cliente.show', ['cliente' => $cliente]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        $paises = Pais::getPaises();
        return view('cliente.edit', [
            'cliente' => $cliente,
            'paises' => $paises
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreClienteRequest $request, Cliente $cliente)
    {
        $cliente->fill($request->validated());
        $cliente->save();
        return to_route('cliente.show', ['cliente' => $cliente->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return to_route('cliente.index');
    }
}
