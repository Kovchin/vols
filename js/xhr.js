//https://www.youtube.com/watch?v=eKCD9djJQKc&t=1568s

const requestURL = 'https://jsonplaceholder.typicode.com/users';

//Функция отдает запрос серверу
function sendRequest(method, url, bodu = null) {
    return new Promise((resolve, reject) => {
        const xhr = new XMLHttpRequest();

        //открываем XHR сессию 
        xhr.open(method, url);
        xhr.setRequestHeader('Content-Type', 'application/json');

        //задаем тип для дефолтного парсинга ответа (можно и без этог но тогода придется пользоваться методом json.parse())
        xhr.responseType = 'json';

        //Заливаем ответ в console.log
        xhr.onload = () => {
            if (xhr.status >= 400) {
                reject(xhr.response);
            } else {
                resolve(xhr.response);
            }
        }

        //отражаем возможные ошибки в логе
        xhr.onerror = () => {
            reject(xhr.response);
        }

        //отдаем запрос 
        xhr.send(JSON.stringify(body));
    });
}

/*
sendRequest('GET', requestURL)
    .then(data => console.log(data))
    .catch(err => console.error(err));
*/

const body = {
    name: 'Pavel',
    age: 39
}

sendRequest('POST', requestURL, body)
    .then(data => console.log(data))
    .catch(err => console.error(err));