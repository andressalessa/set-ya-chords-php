<div class="px-5 mx-auto">
    <form class="flex flex-col mt-4 space-y-4" method="POST" action="/save-setlist">
        <div class="flex flex-col">
            <label class="text-emerald-300">Nome</label>
            <input
                type="text"
                name="name"
                placeholder="Digite o nome do setlist..."
                value="bla"
                class="bg-slate-800 px-2 py-1 rounded-xl placeholder:text-slate-300 focus:outline-none focus:ring-1 focus:ring-emerald-300/75" />
        </div>

        <div class="flex flex-col">
            <label class="text-emerald-300 mb-2">Data</label>

            <div class="relative">
                <input
                    id="dt_event"
                    type="date"
                    name="dt_event"
                    class="bg-slate-800 px-3 py-2 rounded-xl text-slate-100 
                    focus:outline-none focus:ring-1 focus:ring-emerald-300/75
                    appearance-none pr-10 w-1/2" 
                />

                <!-- Ícone do Bootstrap posicionado à direita -->
                <i
                    class="bi bi-calendar-event absolute right-3 top-1/2 -translate-y-1/2 
                    text-emerald-300 pointer-events-none text-sm md:hidden sm:block">
                </i>

                <!-- <span
                    id="dt_event_label"
                    class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm pointer-events-none md:hidden sm:block">
                    Digite a data do evento...
                </span> -->
            </div>
        </div>
        <button
            type="submit"
            action="/save-setlist"
            method="POST"
            class="group mt-2 border-1 border-emerald-300 active:border-cyan-300 px-1 py-1 rounded-xl w-24 ml-auto">
            Salvar
            <i class="bi bi-file-earmark-check text-emerald-300 group-active:text-cyan-300"></i>
        </button>
    </form>
</div>

<script>
    // Script simples para mostrar/ocultar o "placeholder" do date input
    document.addEventListener('DOMContentLoaded', function() {
        const input = document.getElementById('dt_event');
        const label = document.getElementById('dt_event_label');

        if (!input || !label) return;

        const updateLabel = () => {
            // se tiver valor, oculta; se não tiver, mostra
            if (input.value) label.classList.add('hidden');
            else label.classList.remove('hidden');
        };

        // eventos úteis para date: focus, blur, input e change
        input.addEventListener('focus', () => label.classList.add('hidden'));
        input.addEventListener('blur', updateLabel);
        input.addEventListener('input', updateLabel);
        input.addEventListener('change', updateLabel);

        // inicializa estado (útil se o campo já tiver valor vindo do servidor)
        updateLabel();
    });
</script>