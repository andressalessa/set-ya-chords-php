<?php
$data = json_decode(file_get_contents('php://input'), true);

$setlistId = $data['setlistId'];
$order = $data['order'];

$setlistItems = $database
    ->query(
        query: "
            select si.id, si.setlist_id, si.position, si.chord_id
            from setlist_items si
            where si.setlist_id = :setlist_id
            order by si.position ASC
        ",
        class: SetlistItems::class,
        params: ['setlist_id' => $setlistId]
    )
    ->fetchAll();

$i = 0;
foreach ($setlistItems as $setlistItem) {
    $setlistItemSave = new SetlistItems();
    $setlistItemSave->id = $setlistItem->id;
    $setlistItemSave->position = (int) $order[$i];
    $database->updateFromObject('setlist_items', $setlistItemSave);
    ++$i;
}

// Retorna resposta pro fetch
header('Content-Type: application/json');
echo json_encode(['status' => 'ok']);
