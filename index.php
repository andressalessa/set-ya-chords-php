<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "database.php";
require "models/Chord.php";
require "models/Setlist.php";
require "models/SetlistItems.php";
require "helpers.php";
require "rotas.php";

/**
 * TODO
 * O que falta no projeto da cifra
 * 
 * 1. Terminar a edição de cifra ✅
 * 2. Corrigir a pesquisa
 * 3. Criar o cadastro de setlist
 * 4. Criar a tela de visualização do setlist
 * 5. Melhorar o navbar
 */