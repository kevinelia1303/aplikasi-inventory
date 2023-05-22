<?php 
function formatRupiah($nominal){
    return "Rp " . number_format($nominal, 0, ',','.');
}
function formatTotal($nominal){
    return " " . number_format($nominal, 0, ',','.');
}
?>