<div class="group flex mt-4 mx-auto">
    <a
        href="/new-chord"
        class="border-1 border-emerald-300 group-active:border-cyan-300 px-2 py-1 rounded-xl">
        Nova cifra
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
<div class="gap-2 mx-auto max-w-lg grid grid-cols-1 md:grid-cols-2 md:max-w-xl">
    <?php foreach ($chords as $chord) {
        require 'partials/_chord-card.php';
    } ?>
</div>