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
            "select * from cifras where nome like :pesquisa", 
            Cifra::class, 
            ['pesquisa' => "%{$pesquisa}%"]
        )
        ->fetchAll();
}

// dd($cifras);

view('index', ['cifras' => $cifras]);