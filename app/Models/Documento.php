<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Documento extends Model
{
    use Sortable;
    public $table = 'documento';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'id_tipodocumento', 'id_subproceso',
    ];

    public $sortable = [
        'id_tipodocumento', 'id_subproceso'
    ]; 

    /**
     * Un documento pertenece a un tipo
     */
    public function tipodocumento()
    {
        return $this->belongsTo(Tipodocumento::class, 'id_tipodocumento');
    }

    /**
     * Un documento pertenece a un subproceso
     */
    public function subproceso()
    {
        return $this->belongsTo(Subproceso::class, 'id_subproceso');
    }
}