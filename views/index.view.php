<div class="group flex mt-4 mx-auto">
    <a
        href="/nova-cifra"
        class="border-1 border-emerald-300 group-active:border-cyan-300 px-2 py-1 rounded-xl">
        Nova cifra
        <i class="bi bi-file-earmark-plus text-emerald-300 group-active:text-cyan-300"></i>
    </a>
</div>
<div class="group flex items-center gap-2 mx-auto">
    <input
        type="text"
        name="pesquisar"
        placeholder="pesquisar..."
        class="group bg-slate-800 px-2 py-1 rounded-xl placeholder:text-slate-300 focus:outline-none focus:ring-1 focus:ring-emerald-300/75">
    </input>
    <i class="bi bi-search group-focus-within:text-emerald-300/75"></i>
</div>
<div class="gap-2 mx-auto max-w-sm grid grid-cols-2">
    <?php foreach ($cifras as $cifra) : ?>
        <a href="/cifra?id=<?= $cifra->id ?>">
            <div
                class="group bg-slate-800 text-slate-100 p-2 
                        rounded-md flex items-start justify-between hover:bg-slate-700">
                <div>
                    <p class="group-active:text-cyan-300"><?= $cifra->nome ?></p>
                    <p class="text-xs text-slate-300 italic"><?= $cifra->artista ?></p>
                </div>
                <i class="bi bi-box-arrow-up-right text-slate-100 my-auto ml-4 group-active:text-cyan-300"></i>
            </div>
        </a>
    <?php endforeach; ?>
</div>