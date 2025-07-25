<?php

$textoCifra = $_REQUEST['cifra'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $linhas = explode("\n", $textoCifra);

    $cifra = new Cifra();
    $cifra->nome = buscarHeaderEFormatarPorPrefixo($linhas, 'nome');
    $cifra->artista = buscarHeaderEFormatarPorPrefixo($linhas, 'artista');
    $cifra->tom = buscarHeaderEFormatarPorPrefixo($linhas, 'Tom');
    $cifra->intro = buscarHeaderEFormatarPorPrefixo($linhas, 'Intro');
    $cifra->cifra = '';

    $cifra->cifra = separarCifrasELetras($linhas);

    $idGerado = $database->insertFromObject('cifras', $cifra);

    if ($idGerado) {
        $cifra = $database
            ->query("SELECT * FROM cifras WHERE id = ?", Cifra::class, [$idGerado])
            ->fetch();

        header("location: /cifra?id=$idGerado");
    }
}
