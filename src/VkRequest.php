<?php
/**
 * EasyBot
 * PHP Version 7.3.
 *
 * @author   Vinogradov Victor <victor@eslavon.ru>
 * @copyright Vinogradov Victor
 * @license   https://opensource.org/licenses/MIT MIT License
 */

namespace Eslavon\Easybot;

use CURLFile;

/**
 * VkRequest - отправка запросов к VK_API
 */
class VkRequest extends EasybotException
{
   	/**
     * Отправка запросов к VK_API
     *
     * @param string $method - метод API VK
     * @param array $params - параметры запроса к API
     *
     * @return array
     *
     * @throws EasybotException
     */
    public function request($method,$params)
    {
		$url = "https://api.vk.com/method/".$method;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type:multipart/form-data"]);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        $result = curl_exec($ch);
 		if ($result === FALSE) {
			$error = curl_error($curl);
        	throw new EasybotException($error);
        }       
        curl_close($ch);      
        $data = json_decode($result,true);
        if (json_last_error() !== JSON_ERROR_NONE) {
        	$error = "JSON ERROR: ".json_last_error_msg();
        	throw new EasybotException($error);
        }
        if (isset($data["error"])) {
        	$error = $data["error"]["error_msg"];
        	throw new EasybotException($error);
        }
		return $data;
	}

    /**
     * Загрузка файла на сервер
     *
     * @param string $peer_id - ID назначения
     * @param string $file - Локальный путь до файла
     * @return string $upload_url - URL сервера для загрузки
     *
     * @return array
     *
     * @throws EasybotException
     */
    public function upload($peer_id,$file,$upload_url)
    {
        $post = [ "file" => new CURLFile(realpath($file)) ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $upload_url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type:multipart/form-data"]);        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        $result = curl_exec($ch);
        if ($result === FALSE) {
            $error = curl_error($curl);
            throw new EasybotException($error);
        }       
        curl_close($ch);  
        $data = json_decode($result,true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            $error = "JSON ERROR: ".json_last_error_msg();
            throw new EasybotException($error);
        }
        if (isset($data["error"])) {
            $error = $data["error"]["error_msg"];
            throw new EasybotException($error);
        }
        return $data;     
    }
}

