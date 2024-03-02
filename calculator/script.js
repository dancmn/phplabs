const display = document.getElementById('display');

function appendToDisplay(content) {
    display.value += content;
}

function clearDisplay() {
    display.value = '';
}

function calculate() {
    const problem = display.value;

    fetch('calculator.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `problem=${encodeURIComponent(problem)}`
    })
    .then(response => response.text())
    .then(result => {
        window.location.href = `${window.location.pathname}?result=${encodeURIComponent(result)}`;
    })
    .catch(error => console.error('Ошибка:', error));
}

document.addEventListener("DOMContentLoaded", function() {
    const urlParams = new URLSearchParams(window.location.search);
    const result = urlParams.get('result');
    if (result) {
        document.getElementById('display').value = decodeURIComponent(result);
    }
});