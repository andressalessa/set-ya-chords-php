<?php

function separarCifrasELetras(array $linhas): string
{
    // $cifras = [];
    // $letras = [];
    $cifra = '';

    foreach ($linhas as $linha) {
        $linha = trim($linha);

        // Heurística: se mais de 50% das palavras forem acordes, é cifra
        $palavras = preg_split('/\s+/', $linha);
        $total = count($palavras);
        $acordes = 0;

        foreach ($palavras as $p) {
            // Verifica se parece com acorde: ex: C, G/B, F#m, D7, A#, Bb
            if (preg_match('/^[A-G](#|b)?(m|maj|min|dim|aug|\+|°)?[0-9]?\/?[A-G]?(#|b)?$/i', $p)) {
                $acordes++;
            }
        }

        if ($total > 0 && $acordes / $total >= 0.5) {
            $cifra .= "<span class='text-emerald-300'>$linha</span><br>";
            // $cifras[] = $linha;
        } else {
            $cifra .= "$linha<br><br>";
            // $letras[] = $linha;
        }
    }

    return $cifra;

    // return [
    //     'cifras' => $cifras,
    //     'letras' => $letras
    // ];
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
                    : $valor; // só o primeiro
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


function buscaValorPorPrefixo(array &$linhas, string $prefix)
{
    $resultados = [];

    foreach ($linhas as $key => $linha) {
        if (str_starts_with(trim($linha), "$prefix:")) {
            $valor = trim(substr($linha, strlen("$prefix:")));
            unset($linhas[$key]); // remove do array original

            if ($prefix === 'intro') {
                dd($valor);
                $resultados[] = $valor; // guarda todos os intro
            } else {
                return $prefix === 'tom' ? 'Tom: ' . $valor : $valor; // só o primeiro
            }
        }
    }

    if ($prefix === 'intro') {
        return implode("\n", $resultados); // retorna tudo junto com \n
    }

    return '';
}


function defineFormatacaoPorTipoDePrefixo(string $texto)
{
    // // Cifra
    // if (preg_match('/cifra:(.*)/i', $texto, $matches)) {
    //     $conteudo = $matches[1];
    //     return "<span class='text-emerald-300'>$conteudo</span>";
    // }

    // // Letra
    // if (preg_match('/letra:(.*)/i', $texto, $matches)) {
    //     return trim($matches[1]) . "\n\n";
    // }

    // Intro
    if (preg_match('/\[Intro\](.*)/i', $texto, $matches)) {
        $linhas = explode("\n", $texto);
        $resultados = [];

        foreach ($linhas as $linha) {
            if (preg_match('/\[Intro\](.*)/i', $linha, $match)) {
                $resultados[] = "[Intro]<span class='text-emerald-300'>" . $match[1] . "</span>";
            }
        }

        return implode("<br>", $resultados);
    }

    // Tom
    if (preg_match('/Tom:(.*)/i', $texto, $matches)) {
        return 'Tom:' . '<span class="text-emerald-300">' . $matches[1] . '</span>';
    }

    // Secoes
    if (preg_match('/\[(?!Intro\])([^\]]+)\](.*)/i', $texto, $matches)) {
        $marcador = '[' . trim($matches[1]) . ']';
        $conteudo = trim($matches[2]); // o que vier depois do ]

        if ($conteudo === '') {
            // Só o marcador, sem cifras
            return "{$marcador}<br>";
        } else {
            // Marcador + cifras formatadas
            return $marcador . ' <span class="text-emerald-300">' . $conteudo . '</span><br>';
        }
    }

    // Quebra de linha
    if (trim($texto) === '') {
        return $texto;
    }

    return $texto;
}

function view($view, $data = [])
{
    foreach ($data as $key => $value) {
        $$key = $value;
    }

    require "views/template/app.php";
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
