<?php

require_once "../vendor/autoload.php";

use Eslavon\Easybot\VkMessageMethod;


$vk_message = new VkMessageMethod($token,$version);


// Отправка простого сообщения
$message = "Свободу попугаям!";
$vk_message->sendMessage($peer_id,$message);

// Отправка сообщения с изображением
$image = $vk_message->uploadImage($peer_id,"1.jpg"); // Загружаем изображение на сервер Вконатке
$vk_message->addAttachment($image); // Добавляем вложение к сообщению
$vk_message->sendMessage($peer_id,$message);

// Отправка сообщения с документом
$doc = $vk_message->uploadDoc($peer_id,"1.gif"); // Загружаем документы на сервер Вконатке
$vk_message->addAttachment($doc); // Добавляем вложение к сообщению
$vk_message->sendMessage($peer_id,$message);

// Отправка сообщения с записью со стены
$wall = "wall-183224289_76"; // ID записи, соответсвует посту по ссылки https://vk.com/wall-183224289_76
$vk_message->addAttachment($wall); // Добавляем вложение к сообщению
$vk_message->sendMessage($peer_id,$message);

// Отправка сообщения с видео
$video= "video-187195346_456239019"; // ID записи
$vk_message->addAttachment($video); // Добавляем вложение к сообщению
$vk_message->sendMessage($peer_id,$message);

// Отправка сообщения с товаром
$market = "market-183224289_2944218"; // ID товара
$vk_message->addAttachment($market); // Добавляем вложение к сообщению
$vk_message->sendMessage($peer_id,$message);

//Отправка сообщения с аудио
$audio = "audio251510315_456239313"; // ID аудиозаписи
$vk_message->addAttachment($audio); // Добавляем вложение к сообщению
$vk_message->sendMessage($peer_id,$message);

//Отправка опроса
$poll = "poll251510315_352125027"; // ID опроса
$vk_message->addAttachment($poll); // Добавляем вложение к сообщению
$vk_message->sendMessage($peer_id,$message);

//Отправка голосового сообщения
$doc = $vk_message->uploadDoc($peer_id,"1.ogg","audio_message"); // Загружаем аудиосообщение на сервер Вконатке
$vk_message->addAttachment($doc); // Добавляем вложение к сообщению
$vk_message->sendMessage($peer_id,$message);

//Отправка точки на карте
$lat = 40.34; // Широта
$long = 34.35; // Долгота
$vk_message->setLocation($lat,$long); // Добавляем карту к сообщению
$vk_message->sendMessage($peer_id,$message);

//Установить настройки для сообщения
$setting = array("dont_parse_links" => 1, "disable_mentions" => 0); //Параметры
$vk_message->setSetting($setting); //Установить параметры
$vk_message->sendMessage($peer_id,$message);

//Сообщение с клавиатурой
$button1 = ["command","Зеленая кнопка","positive","text"];
$button2 = ["command","Красная кнопка","negative","text"];
$button3 = ["command","Синяя кнопка","primary","text"];
$button4 = ["command","Белая кнопка","secondary","text"];
$button5 = ["command","Местоположение","default","location"];
$button6 = ["command","VK Pay","default","vkpay","action=transfer-to-group&group_id=1&aid=10"];
$button7 = ["command","Vk APPS","default","open_app",6979558,-181108510,"sendKeyboard"];
$button = [[$button1],[$button2],[$button3],[$button4],[$button5],[$button6],[$button7]];
$result = $vk_message->setKeyboard($button);
$vk_message->sendMessage($peer_id,$message);


//Отправка кнопок в режиме inline
$button1 = ["command","Зеленая кнопка","positive","text"];
$button2 = ["command","Красная кнопка","negative","text"];
$button3 = ["command","Синяя кнопка","primary","text"];
$button = [[$button1],[$button2],[$button3]];
$result = $vk_message->setKeyboard($button,"inline");
$vk_message->sendMessage($peer_id,$message);
