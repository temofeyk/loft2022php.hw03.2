#  Домашнее задание №3

Задание выполняется в двух файлах. Файл `src/functions.php` содержит все 10 функций. Функции именуются **task1**, **task2**, **task3**, с маленькой буквы, слитно. Файл с именем `index.php` содержит `require(‘src/functions.php’);` и вызов всех функций.

##  Задание #3.2

1. Скачайте верстку сайта **“Бургерная”**
2.  Внизу вы найдете форму заказа, напишите **скрипт**, обрабатывающий эту форму. **Скрипт должен:**
3.  Проверить, существует ли уже пользователь с таким email, если нет - создать его, если да - увеличить число заказов по этому email. Двух пользователей с одинаковым email быть не может.
4.  Сохранить данные заказа - id пользователя, сделавшего заказ, дату заказа, полный адрес клиента.
5.  Скрипт должен вывести пользователю:

`Спасибо, ваш заказ будет доставлен по адресу: “тут адрес клиента”
Номер вашего заказа: #ID
Это ваш n-й заказ!`

Где **ID** - уникальный идентификатор только что созданного заказа n - общий кол-во заказов, который сделал пользователь с этим email включая текущий

Оформление не требуется, достаточно текста на белом фоне, отбитого переходами строк.