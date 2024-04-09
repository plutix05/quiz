// Funkcja odliczająca czas
function odliczanie(czas) {
    // Wyświetlanie aktualnego czasu
    document.getElementById("timer").innerHTML = czas;

    // Sprawdzenie, czy czas do odliczenia nie osiągnął zera
    if (czas > 0) {
        // Wywołanie funkcji po upływie 1 sekundy
        setTimeout(function() {
            odliczanie(czas - 1);
        }, 1000);
    } 
    // else {
    //     // Po osiągnięciu zera przekierowuje do pliku wpis.html
    //     window.location.href = "wpis.html";
    // }
}

// Rozpoczęcie odliczania od 5 sekund
odliczanie(5);