<?php
    /**
     * Created by PhpStorm.
     * User: marco
     * Date: 01/07/16
     * Time: 12:08
     */

    require 'vendor/autoload.php';

    class Teste extends \Illuminate\Database\Eloquent\Model
    {
        use \Microsistec\DbParser\Propertify;

        protected $table = 'properties';

    }

    $capsule = new Illuminate\Database\Capsule\Manager();

    $capsule->addConnection([
        'driver'    => 'mysql',
        'host'      => 'localhost',
        'database'  => 'betasci_db',
        'username'  => 'root',
        'password'  => '',
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix'    => '',
        'options'   => [
            PDO::ATTR_CASE => PDO::CASE_LOWER,
        ],
    ]);


    $capsule->bootEloquent();
    /**
     * @var Teste $macarena
     */
    $macarena = Teste::first();

    var_dump($macarena->toArray());
