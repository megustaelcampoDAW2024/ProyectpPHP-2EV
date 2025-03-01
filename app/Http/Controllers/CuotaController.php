<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCuotaRequest;
use App\Models\Cuota;
use App\Models\Cliente;
use App\Models\Remesa;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class CuotaController extends Controller
{

    public function __construct()
    {
        $this->middleware('rol:A')->only('index', 'create', 'store', 'show', 'edit', 'update', 'destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $groupedCuotas = Cuota::getCuotasGroupedByCliente();
        $remesas = Remesa::all();
        return view('cuota.index', compact('groupedCuotas', 'remesas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Cliente::all();
        $remesas = Remesa::all();
        return view('cuota.create', compact('clientes', 'remesas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCuotaRequest $request)
    {
        $cuotaValidada = $request->validated();

        if ($cuotaValidada['remesa_id'] == null){
            $cuotaValidada['concepto'] = 'Trabajo Extra';
            $cuotaValidada['fecha_emision'] = now();

        } else {
            $remesa = Remesa::find($cuotaValidada['remesa_id']);
            $cuotaValidada['importe'] = null;
            $cuotaValidada['concepto'] = 'Remesa';
            $cuotaValidada['notas'] = 'Remesa ' . $remesa->id . ' - ' . $remesa->ano;
        }

        $cuota = new Cuota($cuotaValidada);
        $cuota->save();

        return to_route('cuota.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cuota $cuota)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cuota $cuota)
    {
        $clientes = Cliente::all();
        $remesas = Remesa::all();
        return view('cuota.edit',compact('cuota', 'clientes', 'remesas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCuotaRequest $request, Cuota $cuota)
    {
        $cuotaValidada = $request->validated();

        if ($cuotaValidada['remesa_id'] == null){
            $cuotaValidada['concepto'] = 'Trabajo Extra';
        } else {
            $remesa = Remesa::find($cuotaValidada['remesa_id']);
            $cuotaValidada['importe'] = null;
            $cuotaValidada['concepto'] = 'Remesa';
            $cuotaValidada['notas'] = 'Remesa ' . $remesa->id . ' - ' . $remesa->ano;
        }

        $cuota->update($cuotaValidada);

        return redirect()->route('cuota.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cuota $cuota)
    {
        $cuota->delete();
        return redirect()->route('cuota.index');
    }

    public function print(Cuota $cuota)
    {
        $pdf = Pdf::loadView('cuota.factura', compact('cuota'));
        return $pdf->download('factura_cuota_' . $cuota->id . '.pdf');
    }
    
}