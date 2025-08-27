<?php

$chordBody = $_REQUEST['chord'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['_method'])) {
    $linhas = explode("\n", $chordBody);

    $chord = new Chord();
    $chord->chord_name = buscarHeaderEFormatarPorPrefixo($linhas, 'nome');
    $chord->artist = buscarHeaderEFormatarPorPrefixo($linhas, 'artista');
    $chord->tone = buscarHeaderEFormatarPorPrefixo($linhas, 'Tom');
    $chord->intro = buscarHeaderEFormatarPorPrefixo($linhas, 'Intro');
    $chord->chord = '';

    $chord->chord = separarCifrasELetras($linhas);

    $idGerado = $database->insertFromObject('chords', $chord);

    if ($idGerado) {
        $chord = $database
            ->query("SELECT * FROM chords WHERE id = ?", Chord::class, [$idGerado])
            ->fetch();

        header("location: /chord?id=$idGerado");
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['_method']) && $_POST['_method'] === 'PUT') {
    $linhas = explode("\n", $chordBody);

    $chord = new Chord();
    $chord->id = $_POST['id'];
    $chord->chord_name = buscarHeaderEFormatarPorPrefixo($linhas, 'nome');
    $chord->artist = buscarHeaderEFormatarPorPrefixo($linhas, 'artista');
    $chord->tone = buscarHeaderEFormatarPorPrefixo($linhas, 'Tom');
    $chord->intro = buscarHeaderEFormatarPorPrefixo($linhas, 'Intro');
    $chord->chord = '';

    $chord->chord = separarCifrasELetras($linhas);

    $updated = $database->updateFromObject('chords', $chord);

    if ($updated) {
        header("location: /chord?id={$chord->id}");
    } else {
        echo 'Nao foi possivel salvar a cifra';
    }
}
