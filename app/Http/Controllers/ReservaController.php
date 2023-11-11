<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use Illuminate\Http\Request;
use App\Http\Responses\ApiResponse;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $reservas = Reserva::all();
            return ApiResponse::success('Lista de reservas', 200, $reservas);
        } catch (Exception $e) {
            return ApiResponse::error('Error al obtener la lista de reservas: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Store a newly created resource in storage. POST crear
     */
    public function store(Request $request)
    {
        try {
            $reserva = Reserva::create($request->all());
            $reserva->create($request->all());
            return ApiResponse::success('Reserva creada', 200, $reserva);
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('Error al crear reserva' . $e->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Reserva $reserva)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reserva $reserva)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reserva $reserva)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reserva $reserva)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
}