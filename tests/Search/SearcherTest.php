<?php


use MercuryHolidays\Search\Searcher;
use PHPUnit\Framework\TestCase;

class SearcherTest extends TestCase
{

    private $hotel_availability_list = [
        ['name' => 'Hotel A', 'available' => 'False', 'floor' => 1, 'room_no' => 1, 'per_room_price' => 25.80],
        ['name' => 'Hotel A', 'available' => 'False', 'floor' => 1, 'room_no' => 2, 'per_room_price' => 25.80],
        ['name' => 'Hotel A', 'available' => 'True', 'floor' => 1, 'room_no' => 3, 'per_room_price' => 25.80],
        ['name' => 'Hotel A', 'available' => 'True', 'floor' => 1, 'room_no' => 4, 'per_room_price' => 25.80],
        ['name' => 'Hotel A', 'available' => 'False', 'floor' => 1, 'room_no' => 5, 'per_room_price' => 25.80],
        ['name' => 'Hotel A', 'available' => 'False', 'floor' => 2, 'room_no' => 6, 'per_room_price' => 30.10],
        ['name' => 'Hotel A', 'available' => 'True', 'floor' => 2, 'room_no' => 7, 'per_room_price' => 35.00],
        ['name' => 'Hotel B', 'available' => 'True', 'floor' => 1, 'room_no' => 1, 'per_room_price' => 45.80],
        ['name' => 'Hotel B', 'available' => 'False', 'floor' => 1, 'room_no' => 2, 'per_room_price' => 45.80],
        ['name' => 'Hotel B', 'available' => 'True', 'floor' => 1, 'room_no' => 3, 'per_room_price' => 45.80],
        ['name' => 'Hotel B', 'available' => 'True', 'floor' => 1, 'room_no' => 4, 'per_room_price' => 45.80],
        ['name' => 'Hotel B', 'available' => 'False', 'floor' => 1, 'room_no' => 5, 'per_room_price' => 45.80],
        ['name' => 'Hotel B', 'available' => 'False', 'floor' => 2, 'room_no' => 6, 'per_room_price' => 49.00],
        ['name' => 'Hotel B', 'available' => 'False', 'floor' => 2, 'room_no' => 7, 'per_room_price' => 49.00]
    ];


    public function testSearchReturnsCorrectResultMinimum20Maximum30RoomRequired2(): void
    {

        $searcher = (new Searcher())
                        ->add($this->hotel_availability_list)
                        ->search(2, 20, 30)
                        ->ensureRoomBelongToThesameHotelAndRoomIsAdjacentAndOnThesameFloor();

        $this->assertEquals($searcher,
            [
                ["name" => "Hotel A", "available" => "True", "floor" => 1, "room_no" => 3, "per_room_price" => 25.80],
                ["name" => "Hotel A", "available" => "True", "floor" => 1, "room_no" => 4, "per_room_price" => 25.80]
            ]
        );

    }

    public function testSearchReturnsCorrectResultMinimum30Maximu50RoomRequired2(): void
    {
        $searcher = (new Searcher())
                        ->add($this->hotel_availability_list)
                        ->search(2, 30, 50)
                        ->ensureRoomBelongToThesameHotelAndRoomIsAdjacentAndOnThesameFloor();

        $this->assertEquals($searcher,
            [
                ["name" => "Hotel B", "available" => "True", "floor" => 1, "room_no" => 3, "per_room_price" => 45.80],
                ["name" => "Hotel B", "available" => "True", "floor" => 1, "room_no" => 4, "per_room_price" => 45.80]
            ]
        );
    }

    public function testSearchReturnsCorrectResultMinimum25Maximu40RoomRequired1(): void
    {
        $searcher = (new Searcher())
                         ->add($this->hotel_availability_list)
                         ->search(1, 25, 40)
                         ->ensureRoomBelongToThesameHotelAndRoomIsAdjacentAndOnThesameFloor();

        $this->assertEquals($searcher,
            [
                ["name" => "Hotel A", "available" => "True", "floor" => 1, "room_no" => 3, "per_room_price" => 25.80],
                ["name" => "Hotel A", "available" => "True", "floor" => 1, "room_no" => 4, "per_room_price" => 25.80],
                ["name" => "Hotel A", "available" => "True", "floor" => 2, "room_no" => 7, "per_room_price" => 35.00]
            ]
        );
    }
}

