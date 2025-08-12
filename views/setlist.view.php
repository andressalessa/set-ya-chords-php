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
            <!-- <div class="gap-2 mx-auto max-w-lg min-w-sm">
                <div
                    class="group bg-slate-800 text-slate-100 p-2 rounded-md flex justify-between items-center hover:bg-slate-700 cursor-pointer"
                    onclick="toggleSetlist(this)">
                    <?php if (! empty($setlist->total_chords)) : ?>
                        <i class="bi bi-chevron-right text-slate-100 my-auto transition-transform"></i>
                        <?php else: ?>
                            <i class="bi bi-chevron-right text-slate-100 my-auto transition-transform sr-only"></i>
                    <?php endif; ?>
                    <p class="flex-1 ml-2"><?= $setlist->name ?></p>
                    <p class="text-xs text-slate-300 italic"><?= $setlist->total_chords ?> cifras</p>
                    <p class="text-xs text-slate-300 italic"><?= $setlist->dt_event ?></p>
                    <i
                        class="bi bi-box-arrow-up-right text-slate-100 my-auto ml-4 text-lg"
                        onclick="openNewScreen(event, '/play-setlist?id=<?= $setlist->id ?>')"></i>
                    <i
                        class="bi bi-pencil-square ml-2 text-lg"
                        onclick="editSetlist(event, '/alter-setlist?id=<?= $setlist->id ?>')"></i>
                </div>

                <div class="hidden pl-6 mt-2 text-slate-200 space-y-1">
                    <?php foreach ($setlistItems as $setlistItem) : ?>
                        <?php if ($setlistItem->setlist_id == $setlist->id) : ?>
                            <a href="/cifra?id=<?= $setlistItem->chord_id ?>" target="_blank" class="underline underline-offset-4">
                                <p><?= $setlistItem->chord_name ?> <span class="text-slate-400 italic">(<?= $setlistItem->artista ?>)</span></p>
                            </a>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div> -->
            <div class="gap-2 mx-auto max-w-lg min-w-sm">
                <div
                    class="group bg-slate-800 text-slate-100 p-2 rounded-md flex justify-between items-center hover:bg-slate-700 cursor-pointer"
                    onclick="toggleSetlist(this)">
                    <?php if (! empty($setlist->total_chords)) : ?>
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

                <div class="hidden pl-6 mt-2 text-slate-200 space-y-1">
                    <?php foreach ($setlistItems as $setlistItem) : ?>
                        <?php if ($setlistItem->setlist_id == $setlist->id) : ?>
                            <a href="/cifra?id=<?= $setlistItem->chord_id ?>" target="_blank" class="underline underline-offset-4">
                                <p><?= $setlistItem->chord_name ?> <span class="text-slate-400 italic">(<?= $setlistItem->artista ?>)</span></p>
                            </a>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <div class="shadow-sm shadow-slate-700 rounded hidden w-[25rem] mt-6 p-1" id="edit-form">
                    <?php require "views/partials/_alter-setlist-form.php" ?>
                </div>
            </div>

        <?php endforeach; ?>

    </div>
    <div class="md:shadow-sm md:shadow-slate-700 md:rounded hidden md:block md:w-[25rem] md:mt-6 md:ml-6 p-4">
        <div class="flex mt-2">
            <h1 class="text-xl text-slate-100 mx-auto">Novo setlist</h1>
        </div>
        <!-- <form class="flex flex-col mt-3" method="POST" action="/save-setlist">
            <label class="text-emerald-300 text-sm">Nome</label>
            <input
                type="text"
                name="name"
                placeholder="Digite o nome do setlist..."
                class="bg-slate-800 px-2 py-1 rounded-lg 
                   placeholder:text-slate-300 text-sm
                   focus:outline-none focus:ring-1 
                   focus:ring-emerald-300/75" />

            <label class="text-emerald-300 text-sm mt-2">Data</label>
            <input
                type="date"
                name="dt_event"
                class="bg-slate-800 px-2 py-1 rounded-lg text-sm
                   focus:outline-none focus:ring-1 
                   focus:ring-emerald-300/75 w-1/2" />

            <button
                type="submit"
                class="group mt-3 border border-emerald-300 active:border-cyan-300 
                   px-2 py-1 rounded-lg w-20 ml-auto text-sm">
                Salvar
                <i class="bi bi-file-earmark-check text-emerald-300 group-active:text-cyan-300"></i>
            </button>
        </form> -->
        <?php require "views/partials/_new-setlist-form.php" ?>
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
        event.stopPropagation(); // impede que o clique vá para o pai
        alert("Abrir nova tela");
        window.location.href = page;
    }

    function editSetlist(event, header) {
        event.stopPropagation();
        const parent = header.parentElement.parentElement;
        const form = parent.querySelector("#edit-form");
        form.classList.toggle("hidden");
    }
</script>