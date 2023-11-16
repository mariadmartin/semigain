<?php

namespace App\Http\Controllers;

use App\Http\Responses\ApiResponse;
use App\Models\Pago;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PagoController extends Controller
{
    // GET - Listado de las pagos
    public function index()
    {
        try {
            //$pagos = Pago::all();
            $pagos = Pago::with('reserva', 'usuario')->get();
            $pagosResponse = [];
            foreach ($pagos as $pago) {
                $array = [
                    'id' => $pago['id'],
                    'cantidad' => $pago['cantidad'],
                    'pagado' => $pago['pagado'],
                    'usuario' => $pago['usuario'],
                    'reserva' => $pago['reserva'],
                    //'created_at'=> $pago['created_at'],
                    //'updated_at'=> $pago['updated_at'],
                ];
                array_push($pagosResponse, $array);
            }
            return ApiResponse::success('Lista de pagos', 200, $pagosResponse);
        } catch (Exception $e) {
            return ApiResponse::error('Error al obtener los pagos: ' . $e->getMessage(), 500);
        }
    }

    // POST - Crear un pago
    public function store(Request $request)
    {
        try {
            request()->validate([
                'usuario_id' => 'required|exists:usuarios,id',
                'reserva_id' => 'required|exists:reservas,id',
                'cantidad' => 'required|numeric|min:0',
                'pagado' => 'required',
            ]);
            $pago = Pago::create($request->all());
            return ApiResponse::success('', 200, $pago);
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('Pago no encontrada', 404);
        }
    }
    // GET by ID
    public function show(Pago $pago)
    {
        try {
            //$pagos = Pago::all();
            $pagos = Pago::with('usuario', 'reserva')->get();
            $pagosResponse = [];
            foreach ($pagos as $pago) {
                $array = [
                    'id' => $pago['id'],
                    'cantidad' => $pago['cantidad'],
                    'pago' => $pago['pago'],
                    'usuario' => $pago['usuario'],
                    'reserva' => $pago['reserva'],
                ];
                array_push($pagosResponse, $array);
            }
            return ApiResponse::success('Pago obtenido', 200, $pagosResponse);
        } catch (Exception $e) {
            return ApiResponse::error('Error al obtener el pago: ' . $e->getMessage(), 404);
        }
    }

    //  PUT - Actualizar Reserva
    public function update(Request $request, Pago $pago)
    {
        try {
            $pago = Pago::findOrFail($pago->id);
            request()->validate([
                'cantidad' => 'required|numeric|min:0',
                'pagado' => 'required',
                'usuario_id' => 'required|exists:usuarios,id',
                'reserva_id' => 'required|exists:reservas,id',
            ]);

            $pago->update($request->all());
            return ApiResponse::success('Reserva actualizada', 200, $pago);
        } catch (ValidationException $e) {
            return ApiResponse::error('Error de validacion', 422);
        }
    }

    // DELETE - borrar registro
    public function destroy(Pago $pago)
    {
        try {
            $pago = Pago::findOrFail($pago->id);
            $pago->delete();
            return ApiResponse::success('Pago borrado', 200, $pago);
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('Pago no encontrado', 404);
        }
    }
}