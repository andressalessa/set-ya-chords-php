<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['_method'])) {
    $setlist = new Setlist();
    $setlist->name = $_POST['name'];
    $setlist->dt_event = $_POST['dt_event'];
    $setlist->id = $database->insertFromObject('setlists', $setlist);
    header("location: /setlist");
}

view('setlist');