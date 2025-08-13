<?php
$data = json_decode(file_get_contents('php://input'), true);

$itemId = $data['itemId'];
$setlistId = $data['setlistId'];

$database->deleteFromObject('setlist_items', (object) ['id' => $itemId]);

$database->query(
    query: "UPDATE setlist_items
        SET position = (
            SELECT new_position
            FROM (
                SELECT id, ROW_NUMBER() OVER (ORDER BY position) AS new_position
                FROM setlist_items
                WHERE setlist_id = :setlist_id
            ) AS subquery
            WHERE subquery.id = setlist_items.id
        )
        WHERE setlist_id = :setlist_id",
    params: [':setlist_id' => $setlistId]
);

// Retorna resposta pro fetch
header('Content-Type: application/json');
echo json_encode(['status' => 'ok']);
