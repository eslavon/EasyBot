<?php

require_once "../vendor/autoload.php";

use Eslavon\Easybot\VkMessageMethod;

$vk_message = new VkMessageMethod($token,$version);

// Отправка сообщения универсальным методом
//$params = array("peer_id" => $peer_id,"message" => "Hello Word");
//$result = $vk_message->messagesSend($params);

//Отправка простого текстового сообщения
//$result = $vk_message->sendMessage($peer_id,"Hello!");
//var_dump($result);

//Отправка простого текстового сообщения c дополнительными параметрами
//$setting = array(
	//"dont_parse_links" => 1, // Не создавать снипет ссылки
	//"disable_mentions" => 1, // Отключить уведомление
	//"intent" => "promo_newsletter" // Интент релкламной рассылки
//);
//$result = $vk_message->sendMessage($peer_id,"Hello!",$setting);

//Отправка текстового соообщения c геоточкой
//$result = $vk_message->sendMessageGeo($peer_id,"Location",40.34,34.35);

// Отправка клавиатуры (не скрываеться после нажатия)
//$button1 = ["command","Зеленая кнопка","positive","text"];
//$button2 = ["command","Красная кнопка","negative","text"];
//$button3 = ["command","Синяя кнопка","primary","text"];
//$button4 = ["command","Белая кнопка","secondary","text"];
//$button5 = ["command","Местоположение","default","location"];
//$button6 = ["command","VK Pay","default","vkpay","action=transfer-to-group&group_id=1&aid=10"];
//$button7 = ["command","Vk APPS","default","open_app",6979558,-181108510,"sendKeyboard"];
//$button = [[$button1],[$button2],[$button3],[$button4],[$button5],[$button6],[$button7]];
//$result = $vk_message->sendMessageButton($peer_id,"Hello",$button);

// Отправка кнопок в режиме inline
$setting = array(
	"dont_parse_links" => 1, // Не создавать снипет ссылки
	"disable_mentions" => 1, // Отключить уведомление
);
$button1 = ["command","Зеленая кнопка","positive","text"];
$button2 = ["command","Красная кнопка","negative","text"];
$button3 = ["command","Синяя кнопка","primary","text"];
$button = [[$button1],[$button2],[$button3]];
$result = $vk_message->sendMessageButton($peer_id,"Hello",$button,"inline",$setting);
var_dump($result);

