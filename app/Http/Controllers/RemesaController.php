<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRemesaRequest;
use App\Models\Remesa;
use App\Models\Cliente;
use App\Models\Cuota;
use App\Mail\CuotaFacturaMailable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class RemesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('remesa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRemesaRequest $request)
    {
        $remesa = new Remesa($request->validated());
        if (isset($request->descipcion)) {
            $remesa->descripcion = 'Remesa ' . $remesa->mes . ' - ' . $remesa->ano;
        }
        $remesa->save();

        if ($request->has('crear_y_enviar')) {
            $this->sendAllCuotas($remesa);
        }
        return to_route('cuota.index');
    }

    /**
     * Send all cuotas.
     */
    public function sendAllCuotas(Remesa $remesa)
{
    $clientes = Cliente::all();
    foreach ($clientes as $cliente) {
        $cuota = Cuota::where('cliente_id', $cliente->id)
            ->where('remesa_id', $remesa->id)->first();

        if ($cuota) {
            $cuota->update([
                'concepto' => 'Remesa',
                'fecha_emision' => now(),
                'notas' => 'Remesa ' . $remesa->mes . ' - ' . $remesa->ano,
            ]);
        } else {
            $cuota = Cuota::create([
                'cliente_id' => $cliente->id,
                'remesa_id' => $remesa->id,
                'concepto' => 'Remesa',
                'fecha_emision' => now(),
                'importe' => $cliente->importe_mensual,
                'moneda' => $cliente->moneda,
                'notas' => 'Remesa ' . $remesa->mes . ' - ' . $remesa->ano,
            ]);
        }

        // Enviar correo con la factura
        Mail::to($cliente->correo)->send(new CuotaFacturaMailable($cuota));
    }
    return to_route('cuota.index');
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Remesa $remesa)
    {
        return view('remesa.edit', compact('remesa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRemesaRequest $request, Remesa $remesa)
    {
        $remesa->update($request->validated());
        if ($request->has('editar_y_enviar')) {
            $this->sendAllCuotas($remesa);
        }
        return to_route('cuota.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Remesa $remesa)
    {
        $remesa->delete();
        return to_route('cuota.index');
    }
}