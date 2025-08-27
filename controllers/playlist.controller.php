<?php
$pesquisa = $_REQUEST['pesquisar'] ?? null;

if (!$pesquisa) {
    $playlists = $database
        ->query(
            query: "
                select pl.id,
                    pl.playlist_name,
                    strftime('%d/%m/%Y', pl.dt_event) as dt_event,
                    count(pli.id) as total_chords
                from playlists pl
                left join playlist_items pli on pl.id = pli.playlist_id
                group by pl.id
                order by pl.dt_event desc
            ",
            // class: Playlist::class
        )->fetchAll();
} else {
    $playlists = $database
        ->query(
            query: "
                select pl.id,
                    pl.playlist_name,
                    strftime('%d/%m/%Y', pl.dt_event) as dt_event,
                    count(pli.id) as total_chords
                from playlists pl
                left join playlist_items pli on pl.id = pli.playlist_id
                where pl.playlist_name like :pesquisa
                group by pl.id
                order by pl.dt_event desc
            ",
            // class: Playlist::class,
            params: ['pesquisa' => "%{$pesquisa}%"]
        )->fetchAll();
}

dd($playlists);

$playlistItems = $database
    ->query(
        query: "
            select pli.playlist_id,
                pli.id as playlist_item_id,
                pl.playlist_name,
                pli.position,
                pli.chord_id,
                c.chord_name,
                c.artist
            from chords c
            inner join playlist_items pli on pl.id = pli.playlist_id
            inner join playlists pl on c.id = pli.chord_id
            order by pli.position
        ",
        // class: PlaylistItems::class
    )
    ->fetchAll();

view('playlist', compact('playlists', 'playlistItems'));
