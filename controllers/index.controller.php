<?php

$pesquisa = $_REQUEST['pesquisar'] ?? null;

if (!$pesquisa) {
    $cifras = $database
        ->query(
            "select * from chords",
            Chord::class
        )
        ->fetchAll();
} else {
    $cifras = $database
        ->query(
            "select * from chords where nome like :pesquisa or artista like :pesquisa",
            Chord::class,
            ['pesquisa' => "%{$pesquisa}%"]
        )
        ->fetchAll();
}

view('index', ['cifras' => $cifras]);
