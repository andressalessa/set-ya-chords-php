<div class="px-5 mx-auto">
    <form class="flex flex-col mt-4 space-y-4" method="POST" action="/save-setlist">
        <div class="flex flex-col">
            <label class="text-emerald-300">Nome</label>
            <input
                type="text"
                name="name"
                placeholder="Digite o nome do setlist..."
                class="bg-slate-800 px-2 py-1 rounded-xl placeholder:text-slate-300 focus:outline-none focus:ring-1 focus:ring-emerald-300/75" />
        </div>

        <div class="flex flex-col">
            <label class="text-emerald-300 mb-2">Data</label>

            <div class="relative w-48">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <i class="bi bi-calendar text-slate-400"></i>
                </div>
                <input
                    type="text"
                    name="dt_event"
                    id="flatpickr-date"
                    class="bg-slate-800 border border-slate-600 text-slate-100 text-sm rounded-lg 
                            focus:ring-emerald-300 focus:border-emerald-300 block w-40 md:w-2/3 lg:w-2/3 pl-10 p-2.5"
                    placeholder="Selecione..."
                    >
            </div>
            <button
                type="submit"
                class="group mt-2 border-1 border-emerald-300 active:border-cyan-300 px-1 py-1 rounded-xl w-24 ml-auto">
                Salvar
                <i class="bi bi-file-earmark-check text-emerald-300 group-active:text-cyan-300"></i>
            </button>
    </form>
</div>