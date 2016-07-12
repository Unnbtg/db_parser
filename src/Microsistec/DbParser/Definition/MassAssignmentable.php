<?php
    /**
     * Created by PhpStorm.
     * User: marco
     * Date: 12/07/16
     * Time: 10:56
     */

    namespace Microsistec\DbParser\Definition;


    interface MassAssignmentable
    {
        function  massAssignment($object, $toConvert, $options);

        function activeOptions($options = null);
    }