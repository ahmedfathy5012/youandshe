<?php

class Helpers{
   static public function getRandomNumberFromZero($max):int
   {
       return fake()->numberBetween(0,$max);
   }
}