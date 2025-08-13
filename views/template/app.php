<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cifra</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
</head>

<body class="bg-slate-900">

    <header class="">
        <div>
            <nav class="flex justify-between p-5">
                <a href="/" class="text-xl text-slate-100">Cifras</a>
                <a href="/setlist" class="text-xl text-slate-100">Setlist</a>
            </nav>

            <hr class="border-t-2 border-emerald-300 opacity-70 mx-4 -mt-2" />
        </div>
    </header>

    <main class="text-slate-100 flex flex-col gap-4">
        <?php require "views/{$view}.view.php"; ?>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="autoscroll.js"></script>

    <script>
        flatpickr('#flatpickr-date', {
            dateFormat: 'd-m-Y', // Formato da data (ex.: 2025-08-12)
            monthSelectorType: 'static', // Mantém o seletor de mês fixo
            prevArrow: '<i class="bi bi-chevron-left text-slate-400"></i>',
            nextArrow: '<i class="bi bi-chevron-right text-slate-400"></i>',
            theme: 'dark' // Tema escuro para combinar com bg-slate-900
        });

        document.addEventListener('DOMContentLoaded', () => {
            const homeLink = document.querySelector('a[href="/"]');
            const setlistLink = document.querySelector('a[href="/setlist"]');

            // Verifica a URL atual
            const currentPath = window.location.pathname;

            // Remove as classes de ambos os links
            homeLink.classList.remove('bg-emerald-300/15', 'px-2', 'py-1', 'rounded-xl');
            setlistLink.classList.remove('bg-emerald-300/15', 'px-2', 'py-1', 'rounded-xl');

            // Adiciona as classes ao link correspondente à URL atual
            if (currentPath === '/' || currentPath === '/nova-cifra' || currentPath === '/cifra') {
                homeLink.classList.add('bg-emerald-300/15', 'px-2', 'py-1', 'rounded-xl');
            } else if (currentPath === '/setlist' || currentPath === '/play-setlist' || currentPath === '/save-setlist') {
                setlistLink.classList.add('bg-emerald-300/15', 'px-2', 'py-1', 'rounded-xl');
            }
        });
    </script>
</body>

</html>