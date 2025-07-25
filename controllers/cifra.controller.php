<?php

$id = $_REQUEST['id'];

$cifra = $database
    ->query(
        "select * from cifras where id = :id", 
        Cifra::class, 
        ['id' => $id]
    )
    ->fetch();

view('cifra', ['cifra' => $cifra]);