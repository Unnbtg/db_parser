<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 01/07/16
 * Time: 15:19
 */

namespace Microsistec\DbParser\Definition;


/**
 * Class Disponibility
 * @package Microsistec\DbParser\Definition
 *
 * @property int type
 * @property float $value
 * @property float $lowSeason
 * @property float $highSeason
 */
class Disponibility
{
    const SELL = 1;
    const RENT = 2;
    const SEASON = 3;

    /**
     * Disponibility constructor.
     */
    public function __construct($type = null, $value = null)
    {
        $this->type = $type;
        $this->value = $value;
    }


}