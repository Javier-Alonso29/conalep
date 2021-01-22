<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Estados;
use App\Models\Planteles;

class Municipios extends Model
{
    public $table = 'municipios';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre','estado_id'];

    /**
     * Un municipio pertenece a un estado
    */
    public function estado()
    {
        return $this->belongsTo(Estados::class, 'estado_id');
    }

    /**
     * Un municipio tiene muchos planteles
     */
    public function planteles()
    {
        return $this->hasMany(Planteles::class,'municipio_id');
    }
}
