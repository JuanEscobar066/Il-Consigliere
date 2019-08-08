<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class AdjuntosPunto extends Model
{
    	protected function setKeysForSaveQuery(Builder $query)
        {
            $query
                    ->where('id_punto', '=', $this->getAttribute('id_punto'))
                    ->where('ruta', '=', $this->getAttribute('ruta'));
            return $query;
        } 
        protected $table = 'adjuntos_punto';
        protected $primaryKey = ['id_punto', 'ruta'];
        public $incrementing = false;
        public $timestamps = false;
}
