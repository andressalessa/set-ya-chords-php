<div class="p-5 mx-auto">
    <form class="flex flex-col space-y-4" id="form-<?= $playlist->id ?>" method="POST" action="/save-playlist">
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="id" id="id" value="<?= $playlist->id ?>">
        <div class="flex flex-col">
            <label class="text-emerald-300">Nome</label>
            <input
                type="text"
                name="name"
                id="name-<?= $playlist->id ?>"
                placeholder="Digite o nome do playlist..."
                value="<?php echo $playlist->playlist_name; ?>"
                class="bg-slate-800 px-2 py-1 rounded-xl placeholder:text-slate-300 focus:outline-none focus:ring-1 focus:ring-emerald-300/75" />
        </div>

        <div class="flex flex-col">
            <label class="text-emerald-300 mb-2">Data</label>
            <div class="flex items-center">
                <div class="relative w-48">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <i class="bi bi-calendar text-slate-400"></i>
                    </div>
                    <input
                        type="text"
                        name="dt_event"
                        id="flatpickr-date-<?= $playlist->id ?>"
                        class="bg-slate-800 border border-slate-600 text-slate-100 text-sm rounded-lg 
                            focus:ring-emerald-300 focus:border-emerald-300 block w-40 md:w-2/3 lg:w-2/3 pl-10 p-2.5"
                        placeholder="Selecione..."
                        value="<?php echo $playlist->dt_event; ?>">
                </div>
            </div>
            <div class="mt-6 space-x-5 items-center mx-auto">
                <button
                    onclick="deletePlaylist(event, <?= $playlist->id ?>)"
                    class="group border-1 border-emerald-300 active:border-cyan-300 px-1 py-1 rounded-xl w-24 ml-auto">
                    Excluir
                    <i class="bi bi-trash3 text-red-400 group-active:text-red-600"></i>
                </button>
                <button
                    type="submit"
                    class="group border-1 border-emerald-300 active:border-cyan-300 px-1 py-1 rounded-xl w-24 ml-auto">
                    Salvar
                    <i class="bi bi-file-earmark-check text-emerald-300 group-active:text-cyan-300"></i>
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    function deletePlaylist(event, playlistId) {
        event.preventDefault();
        const playlistName = document.getElementById(`name-${playlistId}`).value;

        const swalWithBootstrapButtons = Swal.mixin({
            background: '#334155', // slate-800
            color: 'rgb(226 232 240)', // slate-200
            iconColor: 'rgb(245 158 11)', // opcional: amber-500 pro "warning"
            customClass: {
                confirmButton: "bg-emerald-600 text-slate-100 px-4 py-2 rounded-xl hover:bg-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-400",
                cancelButton: "bg-slate-600 text-slate-100 px-4 py-2 rounded-xl hover:bg-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-400",
                popup: "rounded-xl", // só o radius aqui
                title: "text-cyan-300",
                htmlContainer: "text-slate-400", // <— era `content`; o correto é `htmlContainer`
                actions: "space-x-4"
            },
            buttonsStyling: false
        });
        swalWithBootstrapButtons.fire({
            title: "Tem certeza que deseja excluir o playlist?",
            text: `Playlist: ${playlistName}`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Sim, exclua!",
            cancelButtonText: "Não, cancele!",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                fetch('/save-playlist', {
                    method: 'DELETE',
                    body: JSON.stringify({
                        playlistId
                    }),
                    headers: {
                        'Content-Type': 'application/json'
                    }
                }).then(() => {
                    window.location.reload();
                });
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire({
                    title: "Ufa!",
                    text: "Seu playlist está são e salvo :)",
                    icon: "error"
                });
            }
        });
    }
</script>