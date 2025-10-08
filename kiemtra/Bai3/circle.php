<?php
if (isset($_GET['r']) && is_numeric($_GET['r'])){
    $r = (float)$_GET['r'];
    $chuvi = 2 * pi() * $r;
    $dientich = pi() * $r * $r;
    echo "Ban kinh :$r<br>";
    echo "Chuvi: ". round($chuvi, 4) ." <br>";
    echo "Dien tich: ". round($dientich, 4) ." <br>";
} else {
    echo "vui long nhap ban kinh hop le";
}
 

?>