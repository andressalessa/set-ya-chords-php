<!-- <div class="px-5 mx-auto">
    <form class="flex flex-col mt-4 space-y-4" method="POST" action="/save-setlist">
        <div class="flex flex-col">
            <label class="text-emerald-300">Nome</label>
            <input
                type="text"
                name="name" 
                placeholder="Digite o nome do setlist..."
                class="bg-slate-800 px-2 py-1 rounded-xl 
                placeholder:text-slate-300 focus:outline-none 
                focus:ring-1 focus:ring-emerald-300/75"
            />
        </div>    
        <div class="flex flex-col">
            <label class="text-emerald-300">Data</label>
            <input
                type="date"
                name="dt_event"
                placeholder="Digite a data do evento..."
                class="bg-slate-800 px-2 py-1 rounded-xl 
                placeholder:text-slate-300 focus:outline-none 
                focus:ring-1 focus:ring-emerald-300/75"
            />
        </div>
        <button
            type="submit"
            class="group mt-2 border-1 border-emerald-300 active:border-cyan-300 
            px-1 py-1 rounded-xl w-24 ml-auto">
            Salvar
            <i class="bi bi-file-earmark-check text-emerald-300 group-active:text-cyan-300"></i>
        </button>
    </form>
</div> -->
<?php require_once('partials/_new-setlist-form.php') ?>