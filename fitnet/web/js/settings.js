var heightInput = document.getElementById('height');
var weightInput = document.getElementById('weight');

// Az adatbázisból származó értékek beállítása
document.getElementById('height-data').value = heightInput.value;
document.getElementById('weight-data').value = weightInput.value;

// A csúszka értékének beállítása a mellette lévő számmező értékével
heightInput.addEventListener('input', function() {
    updateTextInput(heightInput.value, 'height-data');
});

weightInput.addEventListener('input', function() {
    updateTextInput(weightInput.value, 'weight-data');
});

function updateTextInput(val, elID) {
    document.getElementById(elID).value = val;

    // Az input range értékét arányosan beállítjuk a beírt érték alapján
    var rangeInput = (elID === 'height-data') ? document.getElementById('height') : document.getElementById('weight');
    var min = parseInt(rangeInput.min);
    var max = parseInt(rangeInput.max);

    // Az arányos érték kiszámítása és beállítása
    var scaledValue = (val - min) / (max - min) * 300; // Az 100 a range skálájának maximuma
    rangeInput.value = scaledValue;
}
