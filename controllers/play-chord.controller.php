<?php

$id = $_REQUEST['id'];

$chords = $database
    ->query(
        query: "
            select pl.id, 
                pl.playlist_name, 
                pli.position, 
                pli.chord_id, 
                c.chord_name, 
                c.artist,
                c.tone, 
                c.intro,
                c.chord,
                pli.chord_id
            from chords c
            inner join playlist_items pli on pl.id = pli.playlist_id
            inner join playlists pl on c.id = pli.chord_id
            where pl.id = :id
            order by pli.position
        ",
        // class: PlaylistItems::class,
        params: compact('id')
    
)->fetchAll();

view('play-chord', compact('chords'));