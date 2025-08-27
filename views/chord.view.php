<div class="flex ml-4">
    <div class="group flex mt-4">
        <a
            href="/update-chord?id=<?= $chord->id ?>"
            class="border-1 border-emerald-300 group-active:border-cyan-300 px-2 py-1 rounded-xl">
            Editar cifra
            <i class="bi bi-file-earmark-plus text-emerald-300 group-active:text-cyan-300"></i>
        </a>
    </div>
    <!-- <div class="group flex mt-4 px-4">
        <a
            href="/salvar-pdf?id=<?= $chord->id ?>"
            class="border-1 border-emerald-300 group-active:border-cyan-300 px-2 py-1 rounded-xl">
            Salvar PDF
            <i class="bi bi-file-earmark-pdf text-emerald-300 group-active:text-cyan-300"></i>
        </a>
    </div> -->
</div>
<div class="flex flex-col mt-4">
    <div class="flex flex-col mx-auto justify-center items-center">
        <h1 class="text-2xl text-slate-100"><?= $chord->chord_name ?></h1>
        <h2 class="text-lg text-slate-400 italic"><?= $chord->artist ?></h2>
        <p class="text-md text-slate-300"><?= $chord->tone ?></p>
        <p class="text-md text-slate-300"><?= $chord->intro ?></p>
    </div>
    <div class="ml-4 mt-4 whitespace-pre leading-normal">
        <?php echo $chord->chord ?>
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