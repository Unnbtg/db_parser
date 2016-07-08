<?php
    /**
     * Created by PhpStorm.
     * User: marco
     * Date: 04/07/16
     * Time: 14:44
     */

    namespace Microsistec\DbParser\Definition\Disponibility;


    use Microsistec\DbParser\Definition\DefinitionAbstract;

    abstract class DisponibilityAbstract extends DefinitionAbstract
    {

        protected abstract function getPaymentOptions();

        protected function getPaymentWays($options)
        {
            $this->massAssignment($this->getActiveDefinitions($options), $this->getPaymentOptions());
        }

    }