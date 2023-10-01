<?php
    
$url = 'localhost';
$felhasznalo = 'root';
$pwd = '';
$adatb = "jatekujsag";
$conn = mysqli_connect($url, $felhasznalo, $pwd, "$adatb");
    if(mysqli_connect_errno()){
        exit('Nem sikerült a csatlakozás: ' .mysqli_connect_error());
    }
