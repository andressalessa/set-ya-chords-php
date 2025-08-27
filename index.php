<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

require "database.php";
require "models/Chord.php";
require "models/Playlist.php";
require "models/PlaylistItems.php";
require "helpers.php";
require "routes.php";

/**
 * TODO
 * O que falta no projeto da cifra
 * 
 * 1. Terminar a edição de cifra ✅
 * 2. Corrigir a pesquisa ✅
 * 3. Criar o cadastro de playlist ✅
 * 4. Criar a tela de visualização do playlist ✅
 * 5. Melhorar o navbar ✅
 * 6. Corrigir pesquisa de playlist ✅
 * 7. Criar exclusão de cifra
 * 8. Ajustar o tamanho dos cards das cifras ✅
 * 9. Criar exclusão de playlist
 * 10. Ordenar playlists por data decrescente ✅
 * 11. Futuramente ocultar playlist (mas aí envolve filtros, e tal)
 */