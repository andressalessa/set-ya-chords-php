<?php

$pesquisa = $_REQUEST['pesquisar'] ?? null;

if (!$pesquisa) {
    $cifras = $database
        ->query(
            "select * from cifras",
            Cifra::class
        )
        ->fetchAll();
} else {
    $cifras = $database
        ->query(
            "select * from cifras where nome like :pesquisa or artista like :pesquisa",
            Cifra::class,
            ['pesquisa' => "%{$pesquisa}%"]
        )
        ->fetchAll();
}

view('index', ['cifras' => $cifras]);
