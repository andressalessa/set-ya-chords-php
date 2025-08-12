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