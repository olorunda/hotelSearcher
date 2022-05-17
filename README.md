# Mercury Holidays - Take Home Test
Two more methods were created in the searcher class :

 - `ensureRoomBelongToThesameHotelAndRoomIsAdjacentAndOnThesameFloor()`
 - `removeRoomNotAdjacent()`
 
 The method `ensureRoomBelongToThesameHotelAndRoomIsAdjacentAndOnThesameFloor()`
process the `$available_and_within_budget` variable data stripping off rooms not adjacent and rooms not belonging to thesame hotel

`removeRoomNotAdjacent()` is a private method called within the the `ensureRoomBelongToThesameHotelAndRoomIsAdjacentAndOnThesameFloor()` method to remove
hotels rooms that are not adjacent but within budget

## Test Cases

**Three test cases were created for the criteria painted in the question :**

_Example 1_ : 
Given a criteria of:\
Minimum budget £20 per room.\
Maximum budget £30 per room.\
Number of rooms required is 2.

_Example 2_ :
Given a criteria of:\
Minimum budget £30 per room.\
Maximum budget £50 per room.

_Example 3_ :
Given a criteria of:\
Minimum budget £25 per room.\
Maximum budget £40 per room.\
Number of rooms required is 1.
 
**All tests were passed using the sample property data.** 


