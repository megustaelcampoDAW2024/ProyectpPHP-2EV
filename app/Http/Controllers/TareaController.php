<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTareaRequest;
use App\Http\Requests\UpdateCompleteRequest;
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
        $this->middleware('rol:A')->only('create', 'store', 'edit', 'update', 'destroy');
        $this->middleware('rol:O')->only('complete', 'completeUpdate');
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
        // Guarda la tarea primero para obtener su ID
        $tarea = new Tarea($request->validated());
        $tarea->save();
    
        // Usa el ID de la tarea para crear carpetas únicas
        $tareaId = $tarea->id;
    
        if ($request->hasFile('fichero')) {
            $ficheroPath = $request->file('fichero')->store("ficheros/tarea_$tareaId", 'public');
            $tarea->fichero = $ficheroPath;
        }
    
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store("fotos/tarea_$tareaId", 'public');
            $tarea->foto = $fotoPath;
        }
    
        // Guarda la tarea nuevamente con las rutas de los archivos
        $tarea->save();
    
        return to_route('tarea.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tarea $tarea)
    {
        return view('tarea.show', [
            'tarea' => $tarea
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tarea $tarea)
    {
        $operarios = User::getOperarios();
        $clientes = Cliente::all();
        $provincias = Provincia::all();
        return view('tarea.edit', [
            'tarea' => $tarea,
            'operarios' => $operarios,
            'clientes' => $clientes,
            'provincias' => $provincias
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreTareaRequest $request, Tarea $tarea)
    {
        $tareaValidada = $request->validated();

        // Eliminar fichero anterior si existe y se ha subido uno nuevo
        if ($request->hasFile('fichero')) {
            if ($tarea->fichero) {
                unlink(storage_path('app/public/' . $tarea->fichero));
            }
            $ficheroPath = $request->file('fichero')->store("ficheros/tarea_{$tarea->id}", 'public');
            $tareaValidada['fichero'] = $ficheroPath;
        }

        // Eliminar foto anterior si existe y se ha subido una nueva
        if ($request->hasFile('foto')) {
            if ($tarea->foto) {
                unlink(storage_path('app/public/' . $tarea->foto));
            }
            $fotoPath = $request->file('foto')->store("fotos/tarea_{$tarea->id}", 'public');
            $tareaValidada['foto'] = $fotoPath;
        }

        $tarea->update($tareaValidada);
        
        return to_route('tarea.show', ['tarea' => $tarea]);
        // return "Estado: '" . $tarea->estado . "'" . "Fecha de realización: '" . $tarea->fecha_realizacion . "'";
    }

    public function complete(Tarea $tarea)
    {
        $operarios = User::getOperarios();
        $clientes = Cliente::all();
        $provincias = Provincia::all();
        return view('tarea.edit', [
            'tarea' => $tarea,
            'operarios' => $operarios,
            'clientes' => $clientes,
            'provincias' => $provincias
        ]);
    }

    public function completeUpdate(UpdateCompleteRequest $request, Tarea $tarea)
    {
        $tareaValidada = $request->validated();
        $tareaValidada['estado'] = 'R';

        // Eliminar fichero anterior si existe y se ha subido uno nuevo
        if ($request->hasFile('fichero')) {
            if ($tarea->fichero) {
                unlink(storage_path('app/public/' . $tarea->fichero));
            }
            $ficheroPath = $request->file('fichero')->store("ficheros/tarea_{$tarea->id}", 'public');
            $tareaValidada['fichero'] = $ficheroPath;
        }

        // Eliminar foto anterior si existe y se ha subido una nueva
        if ($request->hasFile('foto')) {
            if ($tarea->foto) {
                unlink(storage_path('app/public/' . $tarea->foto));
            }
            $fotoPath = $request->file('foto')->store("fotos/tarea_{$tarea->id}", 'public');
            $tareaValidada['foto'] = $fotoPath;
        }

        $tarea->update($tareaValidada);
        
        return to_route('tarea.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tarea $tarea)
    {
        $tarea->delete();
        return to_route('tarea.index');
    }
}
