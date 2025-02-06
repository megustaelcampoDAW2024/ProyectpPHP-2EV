<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use App\Models\Usuario;
use Illuminate\Http\Request;

class TareaController extends Controller
{

    public function mostrarTareas()
    {
        $tareas = Tarea::getTareas();
        return view('tareas', 
            ['tareas' => $tareas]
        );
    }
}