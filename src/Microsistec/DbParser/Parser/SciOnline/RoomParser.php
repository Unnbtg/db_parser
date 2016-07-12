<?php
    /**
     * Created by PhpStorm.
     * User: marco
     * Date: 12/07/16
     * Time: 14:10
     */

    namespace Microsistec\DbParser\Parser\SciOnline;


    use Microsistec\DbParser\Models\Property;
    use Microsistec\DbParser\Models\PropertyRoom;

    class RoomParser
    {

        const BEDROOM          = 1;
        const SUITE            = 2;
        const BATHROOM         = 3;
        const ROOM             = 4;
        const KITCHEN          = 5;
        const PARKINGLOT       = 6;
        const HOUSEKEEPER_ROOM = 7;
        const LAVATORY         = 8;
        const PARKING_GARAGE   = 9;


        public function parse($model)
        {
            $rooms = [
                self::BEDROOM => 0,
                self::SUITE => 0,
                self::BATHROOM => 0,
                self::ROOM => 0,
                self::KITCHEN => 0,
                self::PARKINGLOT => 0,
                self::HOUSEKEEPER_ROOM => 0,
                self::LAVATORY => 0,
                self::PARKING_GARAGE => 0,
            ];


            foreach ($model->rooms as $room) {

                try {
                    $rooms[$room->type] += 1;
                } catch (\Exception $e) {
                    var_dump($room, $rooms);exit;
                }


            }

            return $rooms;
        }

    }