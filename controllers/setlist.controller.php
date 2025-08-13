<?php

$setlists = $database
    ->query(
        query: "
            select sl.id,
                sl.name,
                strftime('%d/%m/%Y', sl.dt_event) as dt_event,
                count(si.id) as total_chords
            from setlists sl
            left join setlist_items si on sl.id = si.setlist_id
            group by sl.id
        ",
        class: Setlist::class
    )->fetchAll();

$setlistItems = $database
    ->query(
        query: "
            select sl.id as setlist_id,
                si.id as setlist_item_id,
                sl.name,
                si.position,
                si.chord_id,
                c.nome as chord_name,
                c.artista
            from chords c
            inner join setlist_items si on sl.id = si.setlist_id
            inner join setlists sl on c.id = si.chord_id
            order by si.position
        ",
        class: SetlistItems::class
    )
    ->fetchAll();

// dd($setlistItems);

// dd($setlists);
view('setlist', compact('setlists', 'setlistItems'));
