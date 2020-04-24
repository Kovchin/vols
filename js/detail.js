/**
 * !!!
 * формат JSON для обмена с сервером
 *   let request = {
 *       'section': this.getAttribute('data-section'), //Название секции в которой проводятся изменения
 *       'value': getValue(this), //Значение нового поля
 *   }
 */

//Ловим все элементы изменения которых требуется отслеживать
let myAjax = document.querySelectorAll('.ajax');

//console.log(myAjax);

//Навешиваем обработчик событий на них
for (let i = 0; i < myAjax.length; i++) {
    myAjax[i].onchange = prepareAjax;
}

function prepareAjax() {

    let request = {
        'section': this.getAttribute('data-section'), //Название секции в которой проводятся изменения
        'value': getValue(this),
        'idcrq': document.getElementById('idcrq').getAttribute('data-idcrq'), //id crq в таблице 'fol_list' для внесения изменений в таблице 'fol_working_process' там связка как раз идет по полю id_crq
        'id': document.getElementById('idcrq').getAttribute('data-crq'), //crq в таблице 'fol_list'
        'idcounterparty': this.getAttribute('data-idcounterparty'), //id контрагента по атрибутам элемента
        'fieldName': this.getAttribute('data-fieldName'), //имя поля в базе данных 'fol_working_process'
    }

    console.log(request);

    //отсылаем fetch запрос
    sendRequest('POST', '../ajax/detail.php', request)
        //Успех
        .then(data => {
            if (data['redirect'])
                location.replace(`${data['url']}`);
            console.log(data);
        })
        //Ошибка
        .catch(err => console.error(err));
}

//Функция получает значение элемента в зависимости от того что это за тег
function getValue(element) {

    let value = '';

    /**
     * По умолчанию мы просто достаем value элемента
     * Исключение только для type = input:
        //'value': this[this.selectedIndex].getAttribute('data-idcounterparty'), //Значение нового поля gолучаем id контрагента из 'data-idcounterparty' с элемента option
     * 
     * - если это checkbox то возвращаем 1 если выбрано и null если чекбокс снят
     * - и data если дата выбрана то возвращаем ее если она удалена то null
     * */
    switch (element.tagName) {
        case 'INPUT':
            if (element.type == "checkbox") {
                value = (element.checked) ? 1 : null;
            } else {
                value = (element.value) ? element.value : null;
            }
            break;
        case 'SELECT':
            //console.log(element[element.selectedIndex].getAttribute('data-idcounterparty'));
            if (element[element.selectedIndex].getAttribute('data-idcounterparty')) {
                value = element[element.selectedIndex].getAttribute('data-idcounterparty');
            } else
                value = element.value;
            break;
        default:
            value = element.value;
            break;
    }
    return value;
}