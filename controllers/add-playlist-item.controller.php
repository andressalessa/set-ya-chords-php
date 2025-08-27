<?php

$data = json_decode(file_get_contents('php://input'), true);

$playlistItem = new PlaylistItems();

$playlistItem->playlist_id = $data['playlistId'];
$playlistItem->chord_id = $data['chordId'];
$playlistItem->position = $data['nextPosition'];

$database->insertFromObject('playlist_items', $playlistItem);

// Retorna resposta pro fetch
header('Content-Type: application/json');
echo json_encode(['status' => 'ok']);
