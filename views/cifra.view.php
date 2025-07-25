<div class="flex flex-col mt-4">
    <div class="flex flex-col mx-auto justify-center items-center">
        <h1 class="text-2xl text-slate-100"><?= $cifra->nome ?></h1>
        <h2 class="text-lg text-slate-400 italic"><?= $cifra->artista ?></h2>
        <p class="text-md text-slate-300"><?= $cifra->tom ?></p>
        <p class="text-md text-slate-300"><?= $cifra->intro ?></p>
    </div>
    <div class="ml-4 mt-4 whitespace-pre">
        <?php echo $cifra->cifra ?>
    </div>
</div>