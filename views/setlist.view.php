<!-- 
    setlists -> lista diversos setlists -> cards de setlist
    play-setlist -> tela de visualização de setlist
    novo-setlist -> tela de cadastro de setlist (nome do setlist, data e hora criação) -> ao salvar redireciona pra editar-setlist
    editar-setlist -> tela de edição de setlist (alterar nome do setlist, incluir cifras, excluir cifras, reordenar cifras)
-->

<div class="md:mt-6 md:grid md:grid-cols-2 md:gap-2">
    <div class="flex flex-col space-y-4 ">
        <div class="flex mt-4 mx-auto">
            <h1 class="text-2xl text-slate-100 hidden md:block">Setlists</h1>
            <a
                href="/save-setlist"
                class="border-1 border-emerald-300 group-active:border-cyan-300 px-2 py-1 rounded-xl sm:hidden block">
                Novo setlist
                <i class="bi bi-file-earmark-plus text-emerald-300 group-active:text-cyan-300"></i>
            </a>
        </div>
        <div class="group flex items-center gap-2 mx-auto">
            <form method="GET">
                <input
                    type="text"
                    name="pesquisar"
                    placeholder="pesquisar..."
                    class="group bg-slate-800 px-2 py-1 rounded-xl placeholder:text-slate-300 focus:outline-none focus:ring-1 focus:ring-emerald-300/75">
                </input>
                <button type="submit">
                    <i class="bi bi-search group-focus-within:text-emerald-300/75"></i>
                </button>
            </form>
        </div>

        <?php foreach ($setlists as $setlist) : ?>
            <div class="gap-2 mx-auto max-w-lg min-w-sm">
                <div
                    class="group bg-slate-800 text-slate-100 p-2 rounded-md flex justify-between items-center hover:bg-slate-700 cursor-pointer"
                    onclick="toggleSetlist(this)">
                    <?php if (!empty($setlist->total_chords)) : ?>
                        <i class="bi bi-chevron-right text-slate-100 my-auto transition-transform"></i>
                    <?php else: ?>
                        <i class="bi bi-chevron-right text-slate-100 my-auto transition-transform sr-only"></i>
                    <?php endif; ?>

                    <div class="flex items-center flex-1 ml-2">
                        <p><?= $setlist->name ?></p>
                        <p class="text-xs text-slate-300 italic ml-2">
                            (<?= $setlist->total_chords ?> cifras)
                        </p>
                    </div>

                    <p class="text-xs text-slate-300 italic ml-4">
                        <?= $setlist->dt_event ?>
                    </p>

                    <i
                        class="bi bi-box-arrow-up-right text-slate-100 my-auto ml-4 text-lg"
                        onclick="openNewScreen(event, '/play-setlist?id=<?= $setlist->id ?>')"></i>
                    <i
                        class="bi bi-pencil-square ml-2 text-lg"
                        onclick="editSetlist(event, this)"></i>
                </div>

                <div class="hidden mt-2 text-slate-200 space-y-1 p-2">
                    <div class="sortable-list" data-setlist-id="<?= $setlist->id ?>">
                        <?php $countItems = 0; ?>
                        <?php foreach ($setlistItems as $setlistItem) : ?>
                            <?php if ($setlistItem->setlist_id == $setlist->id) : ?>
                                <?php $countItems++; ?>
                                <div
                                    class="flex items-center justify-between bg-slate-700 p-2 rounded"
                                    data-setlistId="<?= $setlist->id ?>"
                                    data-id="<?= $setlistItem->setlist_item_id ?>"
                                    data-position="<?= $setlistItem->position ?>"
                                    >
                                    <span class="cursor-move text-slate-400 mr-2">
                                        <i class="bi bi-list"></i>
                                    </span>
                                    <a href="/cifra?id=<?= $setlistItem->chord_id ?>" target="_blank" class="flex-1 underline underline-offset-3">
                                        <p class="flex-1"><?= $setlistItem->chord_name ?>
                                            <span class="text-slate-400 text-sm italic">(<?= $setlistItem->artista ?>)</span>
                                        </p>
                                    </a>
                                    <button type="button" class="text-red-400 hover:text-red-600 cursor-pointer" onclick="removeChord(this)">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>

                    <button 
                        type="button" 
                        class="mt-2 px-3 py-1 bg-emerald-600 hover:bg-emerald-500 text-white rounded"
                        onclick="openAddChordModal(<?= $setlist->id ?>, <?= $countItems + 1 ?>)">
                        + Adicionar cifra
                    </button>
                </div>

                <div class="shadow-sm shadow-slate-700 rounded hidden w-[20rem] mt-6 p-1 mx-auto" id="edit-form">
                    <?php require "views/partials/_alter-setlist-form.php" ?>
                </div>
            </div>
        <?php endforeach; ?>

        <div id="addChordModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
            <div class="bg-slate-800 p-4 rounded shadow-lg w-[30rem]">
                <h2 class="text-lg font-bold text-white mb-2">Adicionar cifra</h2>
                <input type="text" id="searchChord" class="w-full p-2 mb-2 rounded bg-slate-700 text-white" placeholder="Buscar cifra...">
                <div id="searchResults" class="space-y-1 text-white"></div>
                <button onclick="closeAddChordModal()" class="mt-2 px-3 py-1 bg-red-500 hover:bg-red-400 text-white rounded">Fechar</button>
            </div>
        </div>


    </div>
    <div>
        <div class="md:shadow-sm md:shadow-slate-700 md:rounded hidden md:block w-[25rem] mt-6 ml-6 p-4">
            <div class="flex mt-2">
                <h1 class="text-xl text-slate-100 mx-auto">Novo setlist</h1>
            </div>
            <?php require "views/partials/_new-setlist-form.php" ?>
        </div>
    </div>
</div>

<script>
    function toggleSetlist(header) {
        const icon = header.querySelector(".bi-chevron-right");
        const list = header.nextElementSibling;

        list.classList.toggle("hidden");
        icon.classList.toggle("rotate-90"); // gira o ícone
    }

    function openNewScreen(event, page) {
        event.stopPropagation();
        window.open(page, "_blank");
    }

    function editSetlist(event, header) {
        event.stopPropagation();
        const parent = header.parentElement.parentElement;
        const form = parent.querySelector("#edit-form");
        form.classList.toggle("hidden");
    }

    document.querySelectorAll('.sortable-list').forEach(list => {
        new Sortable(list, {
            handle: '.cursor-move',
            animation: 150,
            onEnd: function(evt) {
                const setlistId = evt.to.dataset.setlistId;
                const order = Array.from(evt.to.children).map(el => el.dataset.position);
                fetch('/update-setlist-order', {
                    method: 'POST',
                    body: JSON.stringify({
                        setlistId,
                        order
                    }),
                    headers: {
                        'Content-Type': 'application/json'
                    }
                });
            }
        });
    });

    function removeChord(btn) {
        const itemId = btn.closest('[data-id]').dataset.id;
        const setlistId = btn.closest('[data-id]').dataset.setlistid;

        fetch('/remove-setlist-item', {
            method: 'POST',
            body: JSON.stringify({
                itemId,
                setlistId
            }),
            headers: {
                'Content-Type': 'application/json'
            }
        }).then(() => {
            btn.closest('[data-id]').remove();
        });
    }

    let currentSetlistId = null;
    let nextPosition = null;

    function openAddChordModal(setlistId, nexPosition) {
        currentSetlistId = setlistId;
        nextPosition = nexPosition;
        document.getElementById('addChordModal').classList.remove('hidden');
    }

    function closeAddChordModal() {
        document.getElementById('addChordModal').classList.add('hidden');
        document.getElementById('searchResults').innerHTML = '';
        document.getElementById('searchChord').value = '';
    }

    document.getElementById('searchChord').addEventListener('input', function() {
        const query = this.value;
        if (query.length < 2) return;
        fetch(`/search-chords?q=${encodeURIComponent(query)}&setlistId=${currentSetlistId}`)
            .then(res => res.json())
            .then(data => {
                const results = document.getElementById('searchResults');
                results.innerHTML = '';
                data.forEach(chord => {
                    const btn = document.createElement('button');
                    btn.textContent = `${chord.nome} (${chord.artista})`;
                    btn.className = "block w-full text-left p-2 hover:bg-slate-600 rounded";
                    btn.onclick = () => addChordToSetlist(chord.id);
                    results.appendChild(btn);
                });
            });
    });

    function addChordToSetlist(chordId) {
        fetch('/add-setlist-item', {
            method: 'POST',
            body: JSON.stringify({
                setlistId: currentSetlistId,
                chordId,
                nextPosition
            }),
            headers: {
                'Content-Type': 'application/json'
            }
        }).then(() => {
            closeAddChordModal();
            location.reload();
        });
    }
</script>