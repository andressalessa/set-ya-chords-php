<?php
$data = json_decode(file_get_contents('php://input'), true);

$playlistId = $data['playlistId'];
$order = $data['order'];

$playlistItems = $database
    ->query(
        query: "
            select si.id, si.playlist_id, si.position, si.chord_id
            from playlist_items si
            where si.playlist_id = :playlist_id
            order by si.position ASC
        ",
        class: PlaylistItems::class,
        params: ['playlist_id' => $playlistId]
    )
    ->fetchAll();

$i = 0;
foreach ($playlistItems as $playlistItem) {
    $playlistItemSave = new PlaylistItems();
    $playlistItemSave->id = $playlistItem->id;
    $playlistItemSave->position = (int) $order[$i];
    $database->updateFromObject('playlist_items', $playlistItemSave);
    ++$i;
}

// Retorna resposta pro fetch
header('Content-Type: application/json');
echo json_encode(['status' => 'ok']);
