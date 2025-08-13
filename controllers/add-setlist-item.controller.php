<?php

$data = json_decode(file_get_contents('php://input'), true);

$setlistItem = new SetlistItems();

$setlistItem->setlist_id = $data['setlistId'];
$setlistItem->chord_id = $data['chordId'];
$setlistItem->position = $data['nextPosition'];

$database->insertFromObject('setlist_items', $setlistItem);

// Retorna resposta pro fetch
header('Content-Type: application/json');
echo json_encode(['status' => 'ok']);
