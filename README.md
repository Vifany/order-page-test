### Тестовое задание "Лендинговая страница"

Текст задания:

>Тестовое задание:
>- Сверстать простой лэнд, где будет форма заказа с полями для ввода имени и номера телефона, и одно скрытое поле со значением test (об этом ниже будет)
>(можно использовать шаблон из интернета)
>- Если форма была заполнена, то данные должны передаваться в сторонний сервис POST запросом, через PHP (данные будут ниже)
>- Если ответ успешный, то человека нужно перевести на другую страницу с простым текстом “спасибо за заказ”, иначе с текстом “ошибка”
>- Сделать простую валидацию на корректность номера, пример: +7(777)777-77-77
>- Сделать невозможным отправку данных второй раз для одного человека. То есть чтобы не было от одного и тоже человека нескольких одинаковых заявок
>

#### Запуск
`php -S localhost:8000`

#### Устройство
Приложение состоит из двух файлов `index.html` и `process_order.php`


`index.html` - файл с разметкой формы и несколькими короткими JS скриптами позволяющими убирать попап об "успешности" или "ошибке" выполнения \
`process_order.php` - файл содержит код валидирующий поля, проверяющий наличие  форматирующий и отпраляющий запрос к серверу выполнен на PHP без подключения сторонних библиотек 


#### Особенности
Проверка на наличие повторных отправлений одинкаовой информации выполнена "влоб" сохранением пары имя+телефон в csv и проверкой наличия оной пары в файле перед отправкой.

#### Использованные технолгии:
-	![CSS3](https://img.shields.io/badge/css3-%231572B6.svg?style=for-the-badge&logo=css3&logoColor=white)
- ![HTML5](https://img.shields.io/badge/html5-%23E34F26.svg?style=for-the-badge&logo=html5&logoColor=white)
- ![JavaScript](https://img.shields.io/badge/javascript-%23323330.svg?style=for-the-badge&logo=javascript&logoColor=%23F7DF1E)
- ![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white)
