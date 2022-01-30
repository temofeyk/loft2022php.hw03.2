<?php

include './src/config.php';
include './src/class.db.php';
include './src/class.user.php';
include './src/class.order.php';

/*Задача #3.2
Скачайте верстку сайта “Бургерная”
Внизу вы найдете форму заказа, напишите скрипт, обрабатывающий эту форму. Скрипт должен:
Проверить, существует ли уже пользователь с таким email, если нет - создать его,
если да - увеличить число заказов по этому email. Двух пользователей с одинаковым email быть не может.
Сохранить данные заказа - id пользователя, сделавшего заказ, дату заказа, полный адрес клиента.
Скрипт должен вывести пользователю:
            Спасибо, ваш заказ будет доставлен по адресу: “тут адрес клиента”
            Номер вашего заказа: #ID
            Это ваш n-й заказ!
Где ID - уникальный идентификатор только что созданного заказа n - общий кол-во заказов,
который сделал пользователь с этим email включая текущий
Оформление не требуется, достаточно текста на белом фоне, отбитого переходами строк.*/

ini_set('display_errors', 'on');
ini_set('error_reporting', E_NOTICE | E_ALL);

//$burger = new Burger();

$email = $_POST ['email'];
$name = $_POST ['name'];

$addressFields = ['phone', 'street', 'home', 'part', 'apt', 'floor'];
$address = '';
foreach ($_POST as $field => $value) {
    if ($value && in_array($field, $addressFields)) {
        $address .= $value . ', ';
    }
}

$data = ['address' => $address];

$user = new User($email, $name);
$userId = $user->id;
$orderNumber = $user->orders_count + 1;
$order = new Order($userId, $data);
$orderId = $order->id;

echo "Спасибо, ваш заказ будет доставлен по адресу: $address<br>
      Номер вашего заказа: $orderId<br>
      Это ваш $orderNumber заказ!";

