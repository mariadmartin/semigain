<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Usuario extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre','apellidos','fecha_nacimiento','sexo', 'direccion_postal','municipio','provincia', 'imagen_perfil','email','numero_socio','fecha_alta','fecha_baja','es_admin'
    ];

    protected $casts = [
        'fecha_nacimiento' => 'date:d-m-Y',
        'fecha_alta' => 'date:d-m-Y',
    ];

    /**
     * Obtener la reserva saociada con el usuario.
     */
    public function reserva(): HasOne
    {
        return $this->hasOne(Reserva::class);
    }

    /**
     * Obtener los pagos del usuario.
     */
    public function pagos(): HasMany
    {
        return $this->hasMany(Pago::class);
    }
}