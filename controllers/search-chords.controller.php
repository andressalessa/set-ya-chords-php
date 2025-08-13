<?php

header('Content-Type: application/json');

// Captura os parâmetros GET
$q = isset($_GET['q']) ? trim($_GET['q']) : '';
$setlistId = isset($_GET['setlistId']) ? (int) $_GET['setlistId'] : 0;

// Validação simples
if (strlen($q) < 2) {
    echo json_encode([]);
    exit;
}

$chords = $database->query(
    query: "
    SELECT c.id, c.nome, c.artista
      FROM chords c
     WHERE (c.nome LIKE :q OR c.artista LIKE :q)
       AND c.id NOT IN (
           SELECT si.chord_id
             FROM setlist_items si
            WHERE si.setlist_id = :sid
       )
     ORDER BY c.nome ASC
     LIMIT 20
",
    params: [':q' => '%' . $q . '%', ':sid' => $setlistId],
    class: Chord::class
)->fetchAll();

echo json_encode($chords);
