<?php

$textoCifra = $_REQUEST['cifra'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['_method'])) {
    // dd($textoCifra);
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

if (
    $_SERVER['REQUEST_METHOD'] === 'POST'
    && isset($_POST['_method'])
    && $_POST['_method'] === 'PUT'
) {

    // dd($textoCifra);

    $linhas = explode("\n", $textoCifra);

    $cifra = new Cifra();
    $cifra->id = $_POST['id'];
    $cifra->nome = buscarHeaderEFormatarPorPrefixo($linhas, 'nome');
    $cifra->artista = buscarHeaderEFormatarPorPrefixo($linhas, 'artista');
    $cifra->tom = buscarHeaderEFormatarPorPrefixo($linhas, 'Tom');
    $cifra->intro = buscarHeaderEFormatarPorPrefixo($linhas, 'Intro');
    $cifra->cifra = '';

    $cifra->cifra = separarCifrasELetras($linhas);
    
    $updated = $database->updateFromObject('cifras', $cifra);

    if ($updated) {
        header("location: /cifra?id={$cifra->id}");
    } else {
        echo 'Nao foi possivel salvar a cifra';
    }
}
