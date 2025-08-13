<?php

$id = $_REQUEST['id'];

$cifras = $database
    ->query(
        query: "
            select sl.id, 
                sl.name, 
                si.position, 
                si.chord_id, 
                c.nome as chord_name, 
                c.artista as artist,
                c.tom, 
                c.intro,
                c.cifra,
                c.id chord_id
            from chords c
            inner join setlist_items si on sl.id = si.setlist_id
            inner join setlists sl on c.id = si.chord_id
            where sl.id = :id
            order by si.position
        ",
        // class: SetlistItems::class,
        params: compact('id')
    
)->fetchAll();

// dd($cifras);

view('play-setlist', compact('cifras'));