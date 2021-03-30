<?php


// Modifier la dbname (votre login), login et mot de passe

$db = new PDO("mysql:host=localhost;dbname=info642","root","");



function db() { global $db; return $db; }



