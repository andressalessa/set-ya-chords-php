<?php

header('Content-Type: application/json');

// Captura os parâmetros GET
$q = isset($_GET['q']) ? trim($_GET['q']) : '';
$playlistId = isset($_GET['playlistId']) ? (int) $_GET['playlistId'] : 0;

// Validação simples
if (strlen($q) < 2) {
  echo json_encode([]);
  exit;
}

$chords = $database
  ->query(
    query: "
      SELECT c.id, c.chord_name, c.artist
        FROM chords c
      WHERE (c.chord_name LIKE :q OR c.artist LIKE :q)
        AND c.id NOT IN (
            SELECT pli.chord_id
              FROM playlist_items pli
              WHERE pli.playlist_id = :sid
        )
      ORDER BY c.chord_name ASC
      LIMIT 20
      ",
    params: [':q' => '%' . $q . '%', ':sid' => $playlistId],
    class: Chord::class
  )
  ->fetchAll();

echo json_encode($chords);
