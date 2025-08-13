<div class="flex ml-4">
    <div class="group flex mt-4">
        <!-- <a
            href="/editar-cifra?id=<?= $cifra->id ?>"
            class="border-1 border-emerald-300 group-active:border-cyan-300 px-2 py-1 rounded-xl">
            Editar cifra
            <i class="bi bi-file-earmark-plus text-emerald-300 group-active:text-cyan-300"></i>
        </a> -->
    </div>
    <div class="group flex mt-4 px-4">
        <!-- <a
            href="/salvar-pdf?id="
            class="border-1 border-emerald-300 group-active:border-cyan-300 px-2 py-1 rounded-xl">
            Salvar PDF
            <i class="bi bi-file-earmark-pdf text-emerald-300 group-active:text-cyan-300"></i>
        </a> -->
    </div>
</div>
<div class="fixed right-4 top-1/2 transform -translate-y-1/2 flex flex-col items-center z-10">
    <button
        id="speed-up"
        class=" text-emerald-300 p-1 rounded-lg flex items-center"
        data-speed="10">
        <i class="bi bi-plus-square-fill text-lg"></i>
    </button>
    <button id="toggle-scroll" class="bg-emerald-300 text-slate-900 px-2 py-1 rounded-lg flex items-center">
        <i class="bi bi-play-fill"></i>
    </button>
    <button
        id="speed-down"
        class="text-emerald-300 p-1 rounded-lg flex items-center"
        data-speed="10">
        <i class="bi bi-dash-square-fill"></i>
    </button>
</div>

<div class="fixed right-5 top-2/3 mt-2 text-slate-200 space-y-1">
    <div id="list-container" class="flex justify-between transition-transform duration-300 ease-in-out transform translate-x-full">
        <button
            id="toggle-list"
            class="text-emerald-300 p-1 rounded-lg flex my-auto items-center cursor-pointer"
            onclick="toggleList()"
        >
            <i class="bi bi-chevron-double-left"></i>
        </button>
        <div id="song-list" class="shadow-sm shadow-slate-700 rounded p-2 -mr-4">
            <?php foreach ($cifras as $cifra) : ?>
                <a href="#cifra-<?= $cifra['chord_id'] ?>" class="underline underline-offset-4">
                    <p><?= $cifra['chord_name'] ?></p>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php foreach ($cifras as $cifra) : ?>
    <div id="cifra-<?= $cifra['chord_id'] ?>" class="flex flex-col mt-4">
        <div class="flex flex-col mx-auto justify-center items-center">
            <h1 class="text-2xl text-slate-100"><?= $cifra['chord_name'] ?></h1>
            <h2 class="text-lg text-slate-400 italic"><?= $cifra['artist'] ?></h2>
            <p class="text-md text-slate-300"><?= $cifra['tom'] ?></p>
            <p class="text-md text-slate-300"><?= $cifra['intro'] ?></p>
        </div>
        <div class="ml-4 mt-4 whitespace-pre leading-tight">
            <?php echo $cifra['cifra'] ?>
        </div>
    </div>
<?php endforeach ?>

<script>
    function toggleList() {
        const container = document.getElementById('list-container');
        const button = document.getElementById('toggle-list');
        const isHidden = container.classList.contains('translate-x-full');

        if (isHidden) {
            container.classList.remove('translate-x-full');
            container.classList.add('-translate-x-0');
            button.querySelector('i').className = 'bi bi-chevron-double-right text-lg'; // Muda o ícone para direita
        } else {
            container.classList.remove('-translate-x-full');
            container.classList.add('translate-x-full');
            button.querySelector('i').className = 'bi bi-chevron-double-left text-lg'; // Volta para esquerda
        }
    }
</script>