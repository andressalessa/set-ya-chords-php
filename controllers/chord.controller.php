<?php

$id = $_REQUEST['id'];

$chord = $database
    ->query(
        "select * from chords where id = :id", 
        Chord::class, 
        ['id' => $id]
    )
    ->fetch();

view('chord', ['chord' => $chord]);