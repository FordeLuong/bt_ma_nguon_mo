<?php
class MathHelper {
    public static function add($a, $b){
        return $a + $b;
    }
}

class AdvancedMath extends MathHelper{
    public static function pow($a, $b){
        return $a ** $b;
    }
}

// Goi phuong thuc tinh
echo "3 + 5 = " . AdvancedMath::add(3,5) . "<br>";
echo "3 ^ 5 = " . AdvancedMath::pow(3,5) . "<br>";

?>