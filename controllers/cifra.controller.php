<?php

$id = $_REQUEST['id'];

$cifra = $database
    ->query(
        "select * from chords where id = :id", 
        Chord::class, 
        ['id' => $id]
    )
    ->fetch();

view('cifra', ['cifra' => $cifra]);