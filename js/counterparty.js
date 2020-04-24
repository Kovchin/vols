//Ловим все элементы изменения которых требуется отслеживать
let myAjax = document.querySelectorAll('.ajax');

//Навешиваем обработчик событий на них
for (let i = 0; i < myAjax.length; i++) {
    myAjax[i].onchange = prepareAjax;
}

//Функция подготовки fetch запроса
function prepareAjax() {

    let request = {
        'id': this.getAttribute('data-idcounterparty'),
        'fieldName': this.getAttribute('data-fieldName'),
        'value': this.value
    }

    //Отсылаем запрос на сервер
    //отсылаем fetch запрос
    sendRequest('POST', '../ajax/counterparty.php', request)
        .then(data => console.log(data))
        .catch(err => console.error(err));
}