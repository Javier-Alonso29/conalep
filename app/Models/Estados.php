<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estados extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre'];

    /**
     * Un estado tiene muchos municipios
     */
    public function municipios()
    {
        return $this->hasMany(Municipios::class,'estado_id');
    }

}
