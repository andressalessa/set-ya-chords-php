<?php

$pesquisa = $_REQUEST['pesquisar'] ?? null;

if (!$pesquisa) {
    $chords = $database
        ->query(
            "select * from chords",
            Chord::class
        )
        ->fetchAll();
} else {
    $chords = $database
        ->query(
            "select * from chords where nome like :pesquisa or artista like :pesquisa",
            Chord::class,
            ['pesquisa' => "%{$pesquisa}%"]
        )
        ->fetchAll();
}

view('index', ['chords' => $chords]);
