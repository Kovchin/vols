//Ловим все элементы изменения которых требуется отслеживать
let myAjax = document.querySelectorAll('.ajax');

//Навешиваем обработчик событий на них
for (let i = 0; i < myAjax.length; i++) {
    myAjax[i].onchange = prepareAjax;
}

//Функция подготовки fetch запроса
function prepareAjax() {

    let request = {
        'name': this.getAttribute('data-name'),
        'fieldName': this.getAttribute('data-fieldName'),
        'value': this.value
    }
    console.log(request);



    //Отсылаем запрос на сервер
    //отсылаем fetch запрос
    sendRequest('POST', '../ajax/counterparty.php', request)
        .then(data => console.log(data))
        .catch(err => console.error(err));
}