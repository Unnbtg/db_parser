<?php
    /**
     * Created by PhpStorm.
     * User: marco
     * Date: 01/07/16
     * Time: 17:03
     */

    namespace Microsistec\DbParser\Definition\Disponibility;

    /**
     * Class Season
     * @package Microsistec\DbParser\Definition\Disponibility
     * @property float $highSeason
     * @property float $lowSeason
     */
    class Season extends Rent
    {
        public function __construct($model)
        {
            parent::__construct($model);
            $this->highSeason = $model->valor_locacao_alta_temporada;
            $this->lowSeason = $model->valor_locacao_baixa_temporada;
        }
    }