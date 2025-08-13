<?php

$textoCifra = $_REQUEST['cifra'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['_method'])) {
    $linhas = explode("\n", $textoCifra);

    $cifra = new Chord();
    $cifra->nome = buscarHeaderEFormatarPorPrefixo($linhas, 'nome');
    $cifra->artista = buscarHeaderEFormatarPorPrefixo($linhas, 'artista');
    $cifra->tom = buscarHeaderEFormatarPorPrefixo($linhas, 'Tom');
    $cifra->intro = buscarHeaderEFormatarPorPrefixo($linhas, 'Intro');
    $cifra->cifra = '';

    $cifra->cifra = separarCifrasELetras($linhas);

    $idGerado = $database->insertFromObject('chords', $cifra);

    if ($idGerado) {
        $cifra = $database
            ->query("SELECT * FROM chords WHERE id = ?", Chord::class, [$idGerado])
            ->fetch();

        header("location: /cifra?id=$idGerado");
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['_method']) && $_POST['_method'] === 'PUT') {
    $linhas = explode("\n", $textoCifra);

    $cifra = new Chord();
    $cifra->id = $_POST['id'];
    $cifra->nome = buscarHeaderEFormatarPorPrefixo($linhas, 'nome');
    $cifra->artista = buscarHeaderEFormatarPorPrefixo($linhas, 'artista');
    $cifra->tom = buscarHeaderEFormatarPorPrefixo($linhas, 'Tom');
    $cifra->intro = buscarHeaderEFormatarPorPrefixo($linhas, 'Intro');
    $cifra->cifra = '';

    $cifra->cifra = separarCifrasELetras($linhas);

    $updated = $database->updateFromObject('chords', $cifra);

    if ($updated) {
        header("location: /cifra?id={$cifra->id}");
    } else {
        echo 'Nao foi possivel salvar a cifra';
    }
}
