<!-- <a href="/chord?id=<?= $chord->id ?>">
    <div
        class="group bg-slate-800 text-slate-100 p-2 
                        rounded-md flex items-start justify-between hover:bg-slate-700">
        <div>
            <p class="group-active:text-cyan-300"><?= $chord->chord_name ?></p>
            <p class="text-xs text-slate-300 italic"><?= $chord->artist ?></p>
        </div>
        <div class="flex flex-col items-center">
            <i class="bi bi-box-arrow-up-right text-slate-100 group-active:text-cyan-300"></i>
            <i class="bi bi-trash3 text-red-400 hover:text-red-600"></i>
        </div>
    </div>
</a> -->
<div
    onclick="window.location.href='/chord?id=<?= $chord->id ?>'"
    class="group bg-slate-800 text-slate-100 p-2 
           rounded-md flex items-start justify-between hover:bg-slate-700 cursor-pointer">

    <div>
        <p class="group-active:text-cyan-300"><?= $chord->chord_name ?></p>
        <p class="text-xs text-slate-300 italic"><?= $chord->artist ?></p>
    </div>

    <div class="flex flex-col items-center">
        <!-- Ícone que também leva pro link -->
        <i class="bi bi-box-arrow-up-right text-slate-100 group-active:text-cyan-300"
            onclick="event.stopPropagation(); window.location.href='/chord?id=<?= $chord->id ?>'"></i>

        <!-- Ícone da lixeira -->
        <i class="bi bi-trash3 text-red-400 hover:text-red-600"
            onclick="event.stopPropagation(); deleteChord(event, <?= $chord->id ?>, '<?= $chord->chord_name ?>')"></i>
    </div>
</div>

<script>
    function deleteChord(event, chordId, chordName) {
        event.preventDefault();

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
            title: "Tem certeza que deseja excluir a cifra?",
            text: `Cifra: ${chordName}`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Sim, exclua!",
            cancelButtonText: "Não, cancele!",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                fetch('/save-chord', {
                    method: 'DELETE',
                    body: JSON.stringify({
                        chordId
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
                    text: "Sua cifra está sã e salva :)",
                    icon: "error"
                });
            }
        });
    }
</script>