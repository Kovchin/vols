//https://www.youtube.com/watch?v=eKCD9djJQKc&t=1568s

const requestURL = 'https://jsonplaceholder.typicode.com/users';

//Функция отдает запрос серверу
function sendRequest(method, url, body = null) {
    const headers = {
        'Content-Type': "application/json"
    };
    return fetch(url, {
        method: method,
        body: JSON.stringify(body),
        headers: headers
    }).then(response => {
        if (response.ok) {
            return response.json();
        }
        return response.json().then(error => {
            const e = new Error('Что то пошло не так');
            e.data = error;
            throw e;
        })
    })
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

