<?php

namespace MercuryHolidays\Search;

class Searcher
{
    private array $properties;
    private int $rooms_required;
    private array $available_and_within_budget_groupedby_hotel_and_floor=[];
    private array $available_rooms=[];
    private array $available_and_within_budget=[];


    public function add(array $property) : Searcher
    {
        $this->properties= $property;
        return $this;
    }

    public function search(int $roomsRequired, $minimum, $maximum): Searcher
    {
        $this->rooms_required=$roomsRequired;
        $room_count=0;
        foreach($this->properties as $property){
            if($property['available']=='True' && ($property['per_room_price'] >=$minimum && $property['per_room_price']<=$maximum)){
                   $this->available_and_within_budget_groupedby_hotel_and_floor[$property['name']][$property['floor']][$property['room_no']]=$property;
                   $this->available_and_within_budget[]=$property;
                   $room_count++;
            }
        }

        return $this;
    }



    public function ensureRoomBelongToThesameHotelAndRoomIsAdjacentAndOnThesameFloor() : array
    {
        if($this->rooms_required==1){
            return $this->available_and_within_budget;
        }
        $count=0;
        foreach($this->available_and_within_budget_groupedby_hotel_and_floor as $available_and_within_budget_hotel){

            foreach($available_and_within_budget_hotel as $available_and_within_budget_floor){

                if(count($available_and_within_budget_floor)>=$this->rooms_required){
                    sort($available_and_within_budget_floor);
                    foreach($available_and_within_budget_floor as $withing_thesame_floor){
                        if($count==$this->rooms_required){
                            return $this->available_rooms;
                        }

                        $this->available_rooms[]=$withing_thesame_floor;
                        $this->removeRoomNotAdjacent($available_and_within_budget_floor,$count);
                        $count ++;
                    }
                }
            }
        }
        return count(array_values($this->available_rooms))<$this->rooms_required ? [] : array_values($this->available_rooms);
    }


    private function removeRoomNotAdjacent($available_and_within_budget,&$count) : void
    {
        if(isset($available_and_within_budget[$count+1]['room_no']) && isset($this->available_rooms[$count]['room_no'])){
            if(abs($this->available_rooms[$count]['room_no']-$available_and_within_budget[$count+1]['room_no'])>1){
                unset($this->available_rooms[$count]);
                $count --;
            }
        }
    }
}

//



