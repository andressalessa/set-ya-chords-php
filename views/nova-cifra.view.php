<div class="px-4">
    <form class="flex flex-col mt-4" method="POST" action="/cadastrar-cifra">
        <label class="text-emerald-300">Cifra</label>
        <textarea 
            name="cifra" 
            placeholder="Digite a cifra..."
            class="bg-slate-800 px-2 py-1 rounded-xl 
            placeholder:text-slate-300 focus:outline-none 
            focus:ring-1 focus:ring-emerald-300/75
            h-[40rem]"
        ></textarea>

        <!-- PDF pegar daqui -->
        <!-- <a
            href="#"
            class="group mt-2 border-1 border-emerald-300 active:border-cyan-300 px-1 py-1 rounded-xl w-24">
            PDF
            <i class="bi bi-file-earmark-pdf text-emerald-300 group-active:text-cyan-300"></i>
        </a> -->
        <button
            type="submit"
            class="group mt-2 border-1 border-emerald-300 active:border-cyan-300 
            px-1 py-1 rounded-xl w-24 ml-auto">
            Salvar
            <i class="bi bi-file-earmark-check text-emerald-300 group-active:text-cyan-300"></i>
        </button>
    </form>
</div>