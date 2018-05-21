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
 * @property string         $finality
 * @property bool           $saleAvailable
 * @property float          $saleValue
 * @property boolean        $rentAvailable
 * @property float          $rentValue
 * @property boolean        $seasonAvailable
 * @property float          $seasonValue
 * @property bool           $acceptFinancing
 * @property bool           $acceptFgts
 * @property bool           $has_board
 * @property bool           $exchange
 * @property bool           $letterOfCredit
 * @property string         $cep
 * @property int            $floor
 * @property string         $address
 * @property string         $street_number
 * @property string         $complement
 * @property mixed          $neighborhood
 * @property string         $neighborhood_id
 * @property string         $reference_point
 * @property string         $city_id
 * @property string         $zipcode
 * @property string         $condominium_name
 * @property string         $zone
 * @property mixed          $city
 * @property string         $state
 * @property array          $characteristics
 * @property int            $suites
 * @property int            $bathroom
 * @property int            $bedroom
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
 * @property int            $valor_iptu
 * @property string         $gyn
 * @property string         $condominium_price
 * @property string         $iptu_price
 * @property int            $vacation_max
 * @property int            $vacation_parkingLots
 * @property string         $cinema
 * @property string         $package_mercadoLivre
 * @property string         $announcement_title
 * @property string         $video_url
 * @property string         $sell_price
 * @property string         $rent_price
 * @property string         $web_obs
 * @property string         $featured_picture
 * @property string         $page_description
 * @property string         $build_name
 * @property string         $balcony
 * @property string         $area_width
 * @property string         $area_height
 * @property string         $iw_featured
 * @property string         $build_age
 * @property string         $furnished
 * @property string         $olx_token
 * @property string         $website_title
 * @property string         $latitude
 * @property string         $longitude
 * @property string         $longaddressitude
 * @property string         $for_sale
 * @property string         $for_rent
 * @property string         $for_vacation
 * @property array          $portals
 * @property string         $updated_at
 * @property string         $deleted_at
 * @property string         $created_at
 * @property string         $maintence_id
 * @property int            $user_id
 */

class Property extends AbstractParsedType
{

}