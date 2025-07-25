<?php

$textoCifra = $_REQUEST['cifra'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $linhas = explode("\n", $textoCifra);

    $cifra = new Cifra();
    // $cifra->nome = buscaValorPorPrefixo($linhas, 'nome');
    // $cifra->artista = buscaValorPorPrefixo($linhas, 'artista');
    // $cifra->tom = buscaValorPorPrefixo($linhas, 'tom');
    // $cifra->tom = defineFormatacaoPorTipoDePrefixo($cifra->tom);
    
    // $cifra->intro = buscaValorPorPrefixo($linhas, 'intro');
    // $cifra->intro = defineFormatacaoPorTipoDePrefixo($cifra->intro);

    // dd($linhas);
    $cifra->nome = buscarHeaderEFormatarPorPrefixo($linhas, 'nome');
    $cifra->artista = buscarHeaderEFormatarPorPrefixo($linhas, 'artista');
    $cifra->tom = buscarHeaderEFormatarPorPrefixo($linhas, 'Tom');
    $cifra->intro = buscarHeaderEFormatarPorPrefixo($linhas, 'Intro');
    // dd($linhas);

    $cifra->cifra = '';

    // foreach ($linhas as $key => $linha) {
    //     $cifra->cifra .= defineFormatacaoPorTipoDePrefixo($linha);
    // }

    $cifra->cifra = separarCifrasELetras($linhas);

    $idGerado = $database->insertFromObject('cifras', $cifra);

    if ($idGerado) {
        $cifra = $database
            ->query("SELECT * FROM cifras WHERE id = ?", Cifra::class, [$idGerado])
            ->fetch();

        header("location: /cifra?id=$idGerado");
    }
}
