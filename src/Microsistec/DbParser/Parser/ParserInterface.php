<?php
/**
 * Created by PhpStorm.
 * User: unm
 * Date: 3/13/17
 * Time: 5:48 PM
 */

namespace Microsistec\DbParser\Parser;


interface ParserInterface
{
    public function parse($content, $domain ="", $account = "");
}