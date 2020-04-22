//Формируем nodeList с элементами изменения значений которых будем обрабатывать fetch запросами к серверу
let myAjax = document.querySelectorAll('.ajax');


for (let i = 0; i < myAjax.length; i++) {
    myAjax[i].onchange = prepareAjax;
}

//Функция для формирования json объекта для ajax запроса
function prepareAjax() {

    let value = '';

    //Если это checkbox - то при выборе его ставим в запрос 1 при снятии галочки null
    //Если type = date - при выборе новой даты передаем ее если снимается дата то выставляем значение в null
    if (this.type == "checkbox") {
        value = (this.checked) ? 1 : null;
    } else
        value = (this.value) ? this.value : null;

    //Данные для запроса к серверу для формирования SQL запроса к базе данных
    let requset = {
        'crq': this.getAttribute('data-crq'), // номер CRQ данные которого мы меняем
        'value': value, // новое значение поля
        'fieldName': this.getAttribute('data-fieldName') //имя поля в 'fol_list что мы меняем'
    }

    //отсылаем fetch запрос
    sendRequest('POST', '../ajax/summ.php', requset)
        //Успех
        .then(data => {
            (data.resultUpdate == 2) ? console.log('Обновления в базе прошли успешно'): alert('Ошибка данные не внесены в базу')
        })
        //Ошибка
        .catch(err => console.error(err));
}