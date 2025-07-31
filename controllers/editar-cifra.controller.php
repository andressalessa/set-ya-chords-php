<?php

$id = $_REQUEST['id'];

$cifra = $database
    ->query(
        "select * from cifras where id = :id", 
        Cifra::class, 
        ['id' => $id]
    )
    ->fetch();

$cifraParaTextarea = 'nome:' . limparCifraParaEdicao($cifra->nome) . "\n";
$cifraParaTextarea .= 'artista:' . limparCifraParaEdicao($cifra->artista) . "\n";
$cifraParaTextarea .= limparCifraParaEdicao($cifra->tom) . "\n";
$cifraParaTextarea .= limparCifraParaEdicao($cifra->intro);
$cifraParaTextarea .= "\n" . limparCifraParaEdicao($cifra->cifra);

view('editar-cifra', ['cifra' => $cifraParaTextarea, 'id' => $id]);