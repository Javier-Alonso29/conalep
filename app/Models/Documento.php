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
        'nombre', 'id_tipodocumento', 'id_proceso_personal','created_at', 'updated_at'
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
     * Un documento pertenece a un proceso personal
     */
    public function procesopersonal()
    {
        return $this->belongsTo(ProcesoPersonal::class, 'id_proceso_personal');
    }
}