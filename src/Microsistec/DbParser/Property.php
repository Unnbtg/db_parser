<?php
    /**
     * Created by PhpStorm.
     * User: marco
     * Date: 01/07/16
     * Time: 14:19
     */

    namespace Microsistec\DbParser;


    use Illuminate\Database\Eloquent\Model;
    use Microsistec\DbParser\Parser\OldParser;
    use Microsistec\DbParser\Parser\ParserAbstract;
    use phpDocumentor\Reflection\Type;

    /**
     * Class Property
     * @package Microsistec\DbParser
     *
     *
     * @property string         $reference
     * @property bool           $saleAvailable
     * @property float          $saleValue
     * @property boolean        $rentAvailable
     * @property float          $rentValue
     * @property boolean        $seasonAvailable
     * @property float          $seasonValue
     * @property bool           $acceptFinancing
     * @property bool           $exchange
     * @property bool           $letterOfCredit
     * @property string         $cep
     * @property string         $address
     * @property string         $number
     * @property string         $complement
     * @property string         $neighborhood
     * @property string         $zone
     * @property string         $city
     * @property string         $state
     * @property array          $characteristics
     * @property int            $dorms
     * @property int            $suites
     * @property int            $bathroom
     * @property int            $room
     * @property int            $kitchen
     * @property int            $parking_lot
     * @property int            $housekeeper_room
     * @property int            $lavatory
     * @property int            $garage_lot
     * @property float          $total_area
     * @property float          $useful_area
     * @property string         $obs
     * @property int            $age
     * @property string         $type
     * @property array          $disponibility
     * @property string         $subtype
     * @property array          $photos
     * @property ParserAbstract $parser
     */
    class Property
    {

    }