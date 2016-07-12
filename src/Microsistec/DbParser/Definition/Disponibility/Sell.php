<?php
    /**
     * Created by PhpStorm.
     * User: marco
     * Date: 01/07/16
     * Time: 16:59
     */

    namespace Microsistec\DbParser\Definition\Disponibility;

    use Microsistec\DbParser\Definition\DefinitionAbstract;


    /**
     * Class Sell
     *
     * @property bool  $fgts
     * @property bool  $letterCredit
     * @property bool  $inCash
     * @property bool  $financingDirect
     * @property bool  $financingBank
     * @property bool  $exchange
     * @property int   $financing_fee_qtd
     * @property float $financing_fee_value
     * @property float $value
     *
     *
     * @package Microsistec\DbParser\Definition\Disponibility
     */
    class Sell extends DisponibilityAbstract
    {
    }