<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class TareaController extends Controller
{
    public function logInCreate()
    {
        return view('logIn');   
    }

    public function logInStore(Request $request)
    {

        $request->validate([
            'user' => 'required',
            'pass' => 'required'
        ]);
        $resultado = Usuario::where('usuario', $request->user)
            ->where('password', $request->pass)
            ->get();
        if (count($resultado) > 0) {
            return view('inicio');
        } else {
            //return view('error');
        }
    }

    public function inicio()
    {
        return view('inicio');
    }
}