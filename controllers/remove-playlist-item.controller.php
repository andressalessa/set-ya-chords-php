<?php
$data = json_decode(file_get_contents('php://input'), true);

$itemId = $data['itemId'];
$playlistId = $data['playlistId'];

$database->deleteFromObject('playlist_items', (object) ['id' => $itemId]);

$database->query(
    query: "UPDATE playlist_items
        SET position = (
            SELECT new_position
            FROM (
                SELECT id, ROW_NUMBER() OVER (ORDER BY position) AS new_position
                FROM playlist_items
                WHERE playlist_id = :playlist_id
            ) AS subquery
            WHERE subquery.id = playlist_items.id
        )
        WHERE playlist_id = :playlist_id",
    params: [':playlist_id' => $playlistId]
);

// Retorna resposta pro fetch
header('Content-Type: application/json');
echo json_encode(['status' => 'ok']);
