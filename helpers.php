<?php


function limparCifraParaEdicao(string $htmlFormatado): string
{
    // Remove todas as tags <p ...> mas mantém o conteúdo dentro e adiciona quebras de linha
    $semP = preg_replace('/<\/?p[^>]*>/i', "", $htmlFormatado);

    // Remove todas as tags <span ...> mas mantém o conteúdo dentro
    $semSpan = preg_replace('/<span[^>]*>(.*?)<\/span>/i', '$1', $semP);

    // Substitui <br> e <br /> por quebras de linha reais
    $comQuebras = preg_replace('/<br\s*\/?>/i', "\n", $semSpan);

    // Remove espaços excessivos no início/fim
    return trim($comQuebras);
}

function separarCifrasELetras(array $linhas): string
{
    $cifra = '';

    foreach ($linhas as $linha) {
        $linha = $linha; // Remove espaços em branco no início/fim

        // Ignora linhas vazias
        if (empty($linha)) {
            $cifra .= "<p></p>";
            continue;
        }

        $palavras = preg_split('/\s+/', $linha, -1, PREG_SPLIT_NO_EMPTY);
        $total = count($palavras);
        $acordes = 0;

        foreach ($palavras as $p) {
            // Verifica se parece com acorde: ex: C, G/B, F#m, D7, A#, Bb
            if (preg_match('/^[A-G](#|b)?(m|maj|min|dim|aug|\+|°)?[0-9]?\/?[A-G]?(#|b)?$/i', $p)) {
                $acordes++;
            }
        }

        // Linha é considerada cifra se:
        // 1. Tem pelo menos 1 acorde e no máximo 2 palavras, OU
        // 2. Mais de 50% das palavras são acordes
        if (($acordes >= 1 && $total <= 2) || ($total > 0 && $acordes / $total >= 0.5)) {
            $cifra .= "<p class='text-emerald-300 whitespace-pre'>$linha</p>";
        } else {
            $cifra .= "<p>$linha</p>";
        }
    }

    return $cifra;
}

function buscarHeaderEFormatarPorPrefixo(array &$linhas, string $prefix)
{
    // prefixos
    // nome:
    // artista:
    // Tom:
    // [intro]
    $resultadoIntro = [];

    foreach ($linhas as $key => $linha) {
        if (in_array($prefix, ['nome', 'artista', 'Tom'])) {
            if (str_starts_with(trim($linha), "$prefix:")) {
                $valor = trim(substr($linha, strlen("$prefix:")));
                unset($linhas[$key]); // remove do array original

                return $prefix === 'Tom'
                    ? '<br>Tom: ' . "<span class='text-emerald-300'>$valor</span>"
                    : $valor;
            }
        }

        if ($prefix === 'Intro') {
            if (str_starts_with(trim($linha), "[$prefix]")) {
                $valor = trim(substr($linha, strlen("[$prefix]")));
                unset($linhas[$key]); // remove do array original

                $resultadoIntro[] = "[Intro] <span class='text-emerald-300'>" . $valor . "</span>";
            }
        }
    }

    if (count($resultadoIntro) > 0) {
        return implode("<br>", $resultadoIntro);
    }

    return '';
}

function view($view, $data = [])
{
    foreach ($data as $key => $value) {
        $$key = $value;
    }

    require "views/template/app.php";
}

function abort($code) {
    http_response_code($code);
    view($code);
    die();
}

function dump($dump)
{
    echo '<pre>';
    var_dump($dump);
    echo '</pre>';
}
function dd(...$dump)
{
    dump($dump);
    die();
}

// function config($key = null)
// {
//     $config = require 'config.php';
//     if (strlen($key) > 0) {
//         return $config[$key];
//     }

//     return $config;
// }
