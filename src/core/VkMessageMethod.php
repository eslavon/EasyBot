<?php
/**
 * EasyBot
 * PHP Version 7.3.
 *
 * @author   Vinogradov Victor <victor@eslavon.ru>
 * @copyright Vinogradov Victor
 * @license   https://opensource.org/licenses/MIT MIT License
 */

namespace Easybot\Core;

/**
 * VkMessageMethod- методы для работы с сообщениями
 */
class VkMessageMethod extends VkRequest
{
   /**
     * Ключ доступа сообщества
     *
     * @var string
     */	
    private $token;

   /**
     * Версия VK API
     *
     * @var string
     */	
    private $version;

   /**
     * Конструктор класса
     *
     * @param string $token - Ключ доступа сообщества
     * @param string $version - Версия VK API
     *
     */
    public function __construct($token, $version = "5.103")
    {
        $this->token = $token;
        $this->version = $version;
    }

    /**
     * Генерация случайного числа
     *
     * @return int
     */
    private function random()
    {
        $random = mt_rand(-99999999,99999999);
        return $random;
    }

   /**
     * Формируем клавиатуру из массива
     *
     * @param array $array - массив клавиатуры
     * @param mixed $setting - Скрывать ли клавиатуру после нажатия, включить ли режим inline
     *
     * @return string
     */
    private function formationKeyboard($array,$setting = null)
    {
        if ($setting == null) {
            $one_time = false;
            $inline = false;
        } elseif ($setting == "inline") {
            $one_time = false;
            $inline = true;
        } elseif ($one_time == true) {
            $one_time = true;
            $inline = false;
        }

        $keyboard = [];
        $x = 0;
        foreach ($array as $buttons) {
            $y = 0;
            foreach ($buttons as $button) {
                $keyboard[$x][$y]["action"]["type"] = $button[3];

                if ($button[3] == "text") {
                    $keyboard[$x][$y]["action"]["label"] = $button[1];
                    $keyboard[$x][$y]["color"] = $button[2];
                } elseif ($button[3] == "vkpay") {
                    $keyboard[$x][$y]["action"]["hash"] = $button[4];
                } elseif ($button[3] == "open_app") {
                    $keyboard[$x][$y]["action"]["label"] = $button[1];
                    $keyboard[$x][$y]["action"]["app_id"] = $button[4];
                    $keyboard[$x][$y]["action"]["owner_id"] = $button[5];
                    $keyboard[$x][$y]["action"]["hash"] = $button[6];
                }
                
                $keyboard[$x][$y]["action"]["payload"] = '{"command": "'.$button[0].'"}';

                $y++;
            }
            $x++;
        }
            $array_keyboard = ["one_time" => $one_time,"buttons" => $keyboard,"inline"=> $inline];
            $json_keyboard = json_encode($array_keyboard, JSON_UNESCAPED_UNICODE);
            return $json_keyboard;
    }

    /**
     * Отправка сообщения (Универсальный метод)
     *
     * @param array $array_params - массив параметров
     *
     * @return array
     */
    public function messagesSend($array_params)
    {
        $params = array(
            "access_token" => $this->token,
            "v" => $this->version            
        );
        foreach ($array_params as $key => $value) {
            $params[$key] = $value;
        }
        $params["random_id"] = $this->random();
        $method = "messages.send";
        $result = $this->request($method,$params);
        return $result;
    }

    /**
     * Отправка текстового соообщения пользователю/в беседу
     *
     * @param int $peer_id - ID назначения
     * @param string $message - Текст сообщения
     * @param array $setting - Параметры (Сниппет ссылки,Уведомление,Интент)
     *
     * @return array
     */
    public function sendMessage($peer_id,$message,$setting = null)
    {
        $params = array(
            "peer_id" => $peer_id,
            "message" => $message
        );
        if ($setting !== null) {
            foreach ($setting as $key => $value) {
                $params[$key] = $value;
            }
        }
        $result = $this->messagesSend($params);
        return $result;
    }

    /**
     * Отправка текстового соообщения c геоточкой
     *
     * @param int $peer_id - ID назначения
     * @param string $message - Текст сообщения
     * @param float $lat - географическая широта (от -90 до 90).
     * @param float $long - географическая долгота (от -180 до 180).
     * @param array $setting - Параметры (Сниппет ссылки,Уведомление,Интент)
     *
     * @return array
     */
    public function sendMessageGeo($peer_id,$message,$lat,$long,$setting = null)
    {
        $params = array(
            "peer_id" => $peer_id,
            "message" => $message,
            "lat" => $lat,
            "long" => $long
        );
        if ($setting !== null) {
            foreach ($setting as $key => $value) {
                $params[$key] = $value;
            }
        }
        $result = $this->messagesSend($params);
        return $result;
    }

    /**
     * Отправка сообщения с клавиатурой
     *
     * @param int $peer_id - ID назначения
     * @param string $message - Текст сообщения
     * @param array $button - массив кнопок
     * @param mixed $one_time - true - скрывать клавиатуру после нажатия, false - нет, inline -режим inline.
     * @param array $setting - Параметры (Сниппет ссылки,Уведомление,Интент)
     *
     * @return array
     */
    public function sendMessageButton($peer_id,$message,$button,$one_time = null,$setting = null)
    {
        $params = array(
            "message" => $message,
            "peer_id" => $peer_id,
            "keyboard" => $this->formationKeyboard($button,$one_time)
            );
        if ($setting !== null) {
            foreach ($setting as $key => $value) {
                $params[$key] = $value;
            }
        }       
        $result = $this->messagesSend($params);
        return $result;
    }
}

