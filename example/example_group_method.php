<?php

require_once "../vendor/autoload.php";

use Easybot\Core\VkGroupMethod;
$vk_group = new VkGroupMethod($token,$version);

// Добавить адрес Callback
// $result = $vk_group->addCallbackServer($group_id,$url,$title,$secret_key);
// var_dump($result);

// Получить строку потверждения
// $result = $vk_group->getConfirm;ation($group_id);
// var_dump($result);

// Установить настройки Callback
//$server_id = 18;
//$type = array("message_new" => 1);
//$result = $vk_group->setCallbackSetting($group_id,$server_id,$version,$type);
//var_dump($result);

// Настройки сообщества
// $messages = 0;
// $bots = array("bots_capabilities"=>0,"bots_start_button" => 0,"bots_add_to_chat" => 0);
// $result = $vk_group->groupSetting($group_id,$messages,$bots);
// var_dump($result);

// Удалить сервер
// $server_id = 18;
// $result = $vk_group->delCallbackServer($group_id,$server_id);
// var_dump($result);

// Получить данные о серверах
//$result = $vk_group->getCallbackServer($group_id);
//var_dump($result);

// Получить настройки уведомлений Callback API для сообщества.
//$server_id = 17;
//$result = $vk_group->getCallbackSetting($group_id,$server_id);
//var_dump($result);

// Возвращает настройки прав для ключа доступа сообщества.
// $result = $vk_group->getTokenPermissions();
// var_dump($result);
