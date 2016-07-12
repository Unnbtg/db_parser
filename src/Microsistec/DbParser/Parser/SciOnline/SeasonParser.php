<?php
    /**
     * Created by PhpStorm.
     * User: marco
     * Date: 12/07/16
     * Time: 12:17
     */

    namespace Microsistec\DbParser\Parser\SciOnline;


    use Microsistec\DbParser\Definition\Disponibility\Season;

    class SeasonParser
    {

        public function parse($model)
        {
            $season = new Season;

            foreach ($model->vacations as $vacation) {
                if ($vacation->type == 2) {
                    $season->value = $vacation->price;
                }
            }

            return $season;
        }


    }