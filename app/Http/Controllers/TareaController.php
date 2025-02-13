<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTareaRequest;
use App\Models\Cliente;
use App\Models\Provincia;
use App\Models\Tarea;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TareaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('rol:A')->only('edit', 'update', 'create', 'store', 'destroy');
        $this->middleware('rol:O')->only('edit', 'update');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if($user->rol === 'A') {
            $tareas = Tarea::getAllTareas();
        } else {
            $tareas = Tarea::getTareasByOperario($user->id);
        }
        return view('tarea.index', 
            ['tareas' => $tareas]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $operarios = User::getOperarios();
        $clientes = Cliente::all();
        $provincias = Provincia::all();
        return view('tarea.create', [
            'operarios' => $operarios,
            'clientes' => $clientes,
            'provincias' => $provincias
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTareaRequest $request)
    {
        $tarea = new Tarea($request->validated());
        $tarea->save();
        return to_route('tarea.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tarea $tarea)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tarea $tarea)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tarea $tarea)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tarea $tarea)
    {
        //
    }
}
