const userInput = document.querySelector('.calculator__input');
const buttons = document.querySelectorAll('.calculator__button');

function calculator(){
    fetch('calculator.php', {
    method: 'POST',
    body: new URLSearchParams({ expression: userInput.value })
    })
    .then(response => response.text())
    .then(result => userInput.value = result);
}

buttons.forEach((item) => {
    item.addEventListener('click', function(event) {
        if (item.textContent === 'Посчитать') {
            calculator();
        } else if (item.textContent === 'Сбросить') {
            userInput.value = '';
        } else {
            userInput.value += event.target.textContent;
        }
    });
    
})