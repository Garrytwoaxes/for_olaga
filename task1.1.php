<?php
Class A {
   Public function getDate()
   {
   Return array(
         'count' => 1);
   }
   }
   Class B extends A {
      public function printInfo()	
      { 
         $b = array('sumc' => 2);
         Return array_merge($this->getDate(),$b); 
      }
     }

     $obj = new B();
     print_r ($obj->printInfo());
     
?>
   