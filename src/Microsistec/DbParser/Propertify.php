<?php
namespace Microsistec\DbParser;

use Microsistec\DbParser\Parser\NewParser;
use Microsistec\DbParser\Parser\OldParser;

/**
 * Created by PhpStorm.
 * User: marco
 * Date: 01/07/16
 * Time: 12:08
 */
trait Propertify
{

    /**
     * @return Property
     */
    public function toProperty()
    {
        $parser = $this->getApporpriateParser();
        return $parser->parse($this);
    }


    public function getApporpriateParser()
    {
        if (isset($this->cod_filial)) {
            return new OldParser();
        }

        return new NewParser();
    }
}