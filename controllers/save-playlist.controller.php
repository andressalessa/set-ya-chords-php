<?php
// Configura os cabeçalhos CORS
// header("Access-Control-Allow-Origin: https://playchords.kesug.com"); // Permite apenas sua origem
// header("Access-Control-Allow-Methods: GET, POST, DELETE, OPTIONS"); // Permite métodos necessários
// header("Access-Control-Allow-Headers: Content-Type, Authorization"); // Permite cabeçalhos usados
// header("Access-Control-Max-Age: 86400"); // Cacheia o preflight por 24 horas

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['_method'])) {
    $playlist = new Playlist();
    $playlist->playlist_name = $_POST['name'];
    $formatedDate = (DateTime::createFromFormat('d-m-Y', $_POST['dt_event']))->format('Y-m-d');
    $playlist->dt_event = $formatedDate;
    $playlist->id = $database->insertFromObject('playlists', $playlist);
    header("location: /playlist");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['_method']) && $_POST['_method'] === 'PUT') {
    $playlist = new Playlist();
    $playlist->id = $_POST['id'];
    $playlist->playlist_name = $_POST['name'];
    $formatedDate = (DateTime::createFromFormat('d-m-Y', $_POST['dt_event']))->format('Y-m-d');
    $playlist->dt_event = $formatedDate;
    $database->updateFromObject('playlists', $playlist);
    header("location: /playlist");
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $data = json_decode(file_get_contents('php://input'), true);

    $playlist = new Playlist();
    $playlist->id = $data['playlistId'];
    $database->deleteFromObject('playlists', $playlist);
    // Retorna resposta pro fetch
    header('Content-Type: application/json');
    echo json_encode(['status' => 'ok']);
}

view('new-playlist');