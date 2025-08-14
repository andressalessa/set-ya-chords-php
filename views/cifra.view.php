<div class="flex ml-4">
    <div class="group flex mt-4">
        <a
            href="/editar-cifra?id=<?= $cifra->id ?>"
            class="border-1 border-emerald-300 group-active:border-cyan-300 px-2 py-1 rounded-xl">
            Editar cifra
            <i class="bi bi-file-earmark-plus text-emerald-300 group-active:text-cyan-300"></i>
        </a>
    </div>
    <div class="group flex mt-4 px-4">
        <a
            href="/salvar-pdf?id=<?= $cifra->id ?>"
            class="border-1 border-emerald-300 group-active:border-cyan-300 px-2 py-1 rounded-xl">
            Salvar PDF
            <i class="bi bi-file-earmark-pdf text-emerald-300 group-active:text-cyan-300"></i>
        </a>
    </div>
</div>
<div class="flex flex-col mt-4">
    <div class="flex flex-col mx-auto justify-center items-center">
        <h1 class="text-2xl text-slate-100"><?= $cifra->nome ?></h1>
        <h2 class="text-lg text-slate-400 italic"><?= $cifra->artista ?></h2>
        <p class="text-md text-slate-300"><?= $cifra->tom ?></p>
        <p class="text-md text-slate-300"><?= $cifra->intro ?></p>
    </div>
    <div class="ml-4 mt-4 whitespace-pre leading-normal">
        <?php echo $cifra->cifra ?>
    </div>
</div>