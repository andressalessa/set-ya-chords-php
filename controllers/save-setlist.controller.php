<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['_method'])) {
    dump('post');
    $setlist = new Setlist();
    $setlist->name = $_POST['name'];
    $formatedDate = (DateTime::createFromFormat('d-m-Y', $_POST['dt_event']))->format('Y-m-d');
    $setlist->dt_event = $formatedDate;
    $setlist->id = $database->insertFromObject('setlists', $setlist);
    header("location: /setlist");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['_method']) && $_POST['_method'] === 'PUT') {
    dump('put');
    $setlist = new Setlist();
    $setlist->id = $_POST['id'];
    $setlist->name = $_POST['name'];
    $formatedDate = (DateTime::createFromFormat('d-m-Y', $_POST['dt_event']))->format('Y-m-d');
    $setlist->dt_event = $formatedDate;
    $database->updateFromObject('setlists', $setlist);
    header("location: /setlist");
}

view('new-setlist');