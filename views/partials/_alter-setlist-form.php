<div class="p-5 mx-auto">
    <form class="flex flex-col space-y-4" method="POST" action="/save-setlist">
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="id" value="<?= $setlist->id ?>">
        <div class="flex flex-col">
            <label class="text-emerald-300">Nome</label>
            <input
                type="text"
                name="name"
                placeholder="Digite o nome do setlist..."
                value="<?php echo $setlist->name; ?>"
                class="bg-slate-800 px-2 py-1 rounded-xl placeholder:text-slate-300 focus:outline-none focus:ring-1 focus:ring-emerald-300/75" />
        </div>

        <div class="flex flex-col">
            <label class="text-emerald-300 mb-2">Data</label>
            <!-- <div class="relative">
                <input
                    id="dt_event"
                    type="date"
                    name="dt_event"
                    class="bg-slate-800 px-3 py-2 rounded-xl text-slate-100 
                    focus:outline-none focus:ring-1 focus:ring-emerald-300/75
                    appearance-none pr-10 w-1/2" 
                />

                <i
                    class="bi bi-calendar-event absolute right-3 top-1/2 -translate-y-1/2 
                    text-emerald-300 pointer-events-none text-sm md:hidden sm:block">
                </i>

                <span
                    id="dt_event_label"
                    class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm pointer-events-none md:hidden sm:block">
                    Digite a data do evento...
                </span>
            </div> -->

            <div class="flex items-center">
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
                        value="<?php echo $setlist->dt_event; ?>">
                </div>
                <button
                    type="submit"
                    action="/save-setlist"
                    method="POST"
                    class="group border-1 border-emerald-300 active:border-cyan-300 px-1 py-1 rounded-xl w-24 ml-auto">
                    Salvar
                    <i class="bi bi-file-earmark-check text-emerald-300 group-active:text-cyan-300"></i>
                </button>
            </div>
        </div>
    </form>
</div>