<?php

$id = $_REQUEST['id'];

$chord = $database
    ->query(
        "select * from chords where id = :id", 
        Chord::class, 
        ['id' => $id]
    )
    ->fetch();

$chordToTextArea = 'nome:' . limparCifraParaEdicao($chord->chord_name) . "\n";
$chordToTextArea .= 'artista:' . limparCifraParaEdicao($chord->artist) . "\n";
$chordToTextArea .= limparCifraParaEdicao($chord->tone) . "\n";
$chordToTextArea .= limparCifraParaEdicao($chord->intro);
$chordToTextArea .= "\n" . limparCifraParaEdicao($chord->chord);

view('update-chord', ['chord' => $chordToTextArea, 'id' => $id]);