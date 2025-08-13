let isScrolling = false;
let scrollInterval = null;
let scrollSpeed = 10; // Velocidade padrão em pixels por segundo

function toggleAutoscroll() {
    const toggleButton = document.getElementById('toggle-scroll');
    const icon = toggleButton.querySelector('i');

    if (!isScrolling) {
        // Iniciar o autoscroll
        const pixelsPerFrame = scrollSpeed / 30; // 30 FPS para maior precisão
        scrollInterval = setInterval(() => {
            window.scrollBy({
                top: Math.max(1, pixelsPerFrame), // Garante pelo menos 1px por frame
                behavior: 'smooth'
            });
            // Parar o scroll ao chegar ao final da página
            if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
                clearInterval(scrollInterval);
                isScrolling = false;
                icon.classList.remove('bi-pause-fill');
                icon.classList.add('bi-play-fill');
                // Forçar reposicionamento
                toggleButton.classList.add('-right-7');
            }
        }, 1000 / 30); // 30 FPS
        isScrolling = true;
        icon.classList.remove('bi-play-fill');
        icon.classList.add('bi-pause-fill');

        // Forçar reposicionamento ao iniciar
        toggleButton.classList.add('-right-7');
    } else {
        // Pausar o autoscroll
        clearInterval(scrollInterval);
        isScrolling = false;
        icon.classList.remove('bi-pause-fill');
        icon.classList.add('bi-play-fill');

        // Forçar reposicionamento ao pausar
        toggleButton.classList.add('-right-7');
    }
}

function setScrollSpeed(element) {
    const buttonId = element.getAttribute('id');
    scrollSpeed = parseInt(element.getAttribute('data-speed'));

    if (buttonId === 'speed-up') {
        scrollSpeed += 10;
    } else if (buttonId === 'speed-down') {
        scrollSpeed -= 10;
    }

    element.dataset.speed = scrollSpeed;

    // Se o scroll está ativo, reiniciar com a nova velocidade
    if (isScrolling) {
        clearInterval(scrollInterval);
        const pixelsPerFrame = scrollSpeed / 30;
        scrollInterval = setInterval(() => {
            window.scrollBy({
                top: Math.max(1, pixelsPerFrame), // Garante pelo menos 1px por frame
                behavior: 'smooth'
            });
            if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
                clearInterval(scrollInterval);
                isScrolling = false;
                document.getElementById('toggle-scroll').querySelector('i').classList.remove('bi-pause-fill');
                document.getElementById('toggle-scroll').querySelector('i').classList.add('bi-play-fill');
                // Forçar reposicionamento
                toggleButton.classList.add('-right-7');
            }
        }, 1000 / 30);
    } else {
        toggleAutoscroll();
    }
}

// Inicializar eventos
document.addEventListener('DOMContentLoaded', () => {
    const toggleButton = document.getElementById('toggle-scroll');
    if (toggleButton) {
        toggleButton.addEventListener('click', toggleAutoscroll);
    } else {
        console.log("Elemento #toggle-scroll não encontrado!");
    }

    const speedUpButton = document.getElementById('speed-up');
    const speedDownButton = document.getElementById('speed-down');
    if (speedUpButton && speedDownButton) {
        speedUpButton.addEventListener('click', () => setScrollSpeed(speedUpButton));
        speedDownButton.addEventListener('click', () => setScrollSpeed(speedDownButton));
    } else {
        console.log("Elementos #speed-up ou #speed-down não encontrados!");
    }
});