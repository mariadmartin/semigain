<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pago extends Model
{
    use HasFactory;
    protected $fillable = [
        'cantidad', 'pagado', 'usuario_id', 'reserva_id'
    ];

    /**
     * Obtener el usuario al que pertenece el pago.
     */
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class);
    }

    /**

     * Obtener la reserva que pertenece al pago.
     */
    public function reserva(): BelongsTo
    {
        return $this->belongsTo(Reserva::class);
    }
}