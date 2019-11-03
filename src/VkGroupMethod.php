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

/**
 * VkGroupMethod- методы для работы с сообществом 
 */
class VkGroupMethod extends VkRequest
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
     * Добавляет сервер для Callback API в сообщество.
     *
     * @param int $group_id - ID сообщества
     * @param string $url - URL обработчика CallBack API
     * @param string $title - Название сервера
     * @param string $secret_key - секретный ключ для подписи запросов
     *
     * @return int - ID сервера
     */   
	public function addCallbackServer($group_id,$url,$title,$secret_key)
	{
        $params = array(
			"group_id" => $group_id,
			"url" => $url,
			"title"=>$title,
			"secret_key" => $secret_key,
			"access_token" => $this->token,
			"v" => $this->version
			);		
		$method = "groups.addCallbackServer";
		$result = $this->request($method,$params);
        return $result["response"]["server_id"];
	}

    /**
     * Удаляет сервер для Callback API из сообщества.
     *
     * @param int $group_id - ID сообщества
     * @param int $server_id - ID сервера
     *
     * @return int
     */
    public function delCallbackServer($group_id,$server_id)
    {
        $params = array(
            "group_id" => $group_id,
            "server_id" => $server_id,
            "access_token" => $this->token,
            "v" => $this->version            
        );
        $method = "groups.deleteCallbackServer";
        $result = $this->request($method,$params);
        return $result["response"];
    }

    /**
     * Редактирует данные сервера для Callback API в сообществе.
     *
     * @param int $group_id - ID сообщества
     * @param int $server_id - ID сервера
     * @param string $url - URL обработчика CallBack API
     * @param string $title - Название сервера
     * @param string $secret_key - секретный ключ для подписи запросов
     *
     * @return int
     */   
    public function editCallbackServer($group_id,$server_id,$url,$title,$secret_key)
    {
        $params = array(
            "group_id" => $group_id,
            "server_id" => $server_id,
            "url" => $url,
            "title"=>$title,
            "secret_key" => $secret_key,
            "access_token" => $this->token,
            "v" => $this->version
            );      
        $method = "groups.addCallbackServer";
        $result = $this->request($method,$params);
        return $result["response"];
    }

    /**
     * Получает информацию о серверах для Callback API в сообществе.
     *
     * @param int $group_id - ID сообщества
     * @param int server_ids - идентификаторы серверов, данные о которых нужно получить. 
     *
     * @return array
     */   
    public function getCallbackServer($group_id,$server_ids = null)
    {
        $params = array(
            "group_id" => $group_id,
            "access_token" => $this->token,
            "v" => $this->version
            );  
        if ($server_ids !== null) {
            $params["server_ids"] = $server_ids;
        }    
        $method = "groups.getCallbackServers";
        $result = $this->request($method,$params);
        return $result;
    }

    /**
     * Получить строку, необходимую для подтверждения адреса сервера в Callback API.
     *
     * @param int $group_id - ID сообщества
     *
     * @return string - строка потвержения адреса Callback
     */   
    public function getConfirmation($group_id)
    {
        $params = array(
            "group_id" => $group_id,
            "access_token" => $this->token,
            "v" => $this->version
            );      
        $method = "groups.getCallbackConfirmationCode";
        $result = $this->request($method,$params);
        return $result["response"]["code"];
    }

    /**
     * Задать настройки уведомлений о событиях в Callback API
     *
     * @param int $group_id - ID сообщества
     * @param int $server_id - ID сервера
     * @param string $api_version - Версия Callback API
     * @param array $type - массив с типами событий которые необходимо установить
     * 
     *
     * @return int
     */  
    public function setCallbackSetting($group_id,$server_id,$api_version,$type)
    {
        $params = array(
            "group_id" => $group_id,
            "server_id" => $server_id,
            "api_version" => $api_version,
            "access_token" => $this->token,
            "v" => $this->version            
        );
        foreach ($type as $key => $value) {
            $params[$key] = $value;
        }
        $method = "groups.setCallbackSettings";
        $result = $this->request($method,$params);
        return $result["response"];
    }

    /**
     * Позволяет получить настройки уведомлений Callback API для сообщества.
     *
     * @param int $group_id - ID сообщества
     * @param int server_id - ID сервера
     *
     * @return int
     */  
    public function getCallbackSetting($group_id,$server_id)
    {
        $params = array(
            "group_id" => $group_id,
            "server_id" => $server_id,
            "access_token" => $this->token,
            "v" => $this->version            
        );
        $method = "groups.getCallbackSettings";
        $result = $this->request($method,$params);
        return $result;
    }

    /**
     * Устанавливает настройки сообщества
     *
     * @param int $group_id - ID сообщества
     * @param int $messages - Сообщения сообщества (1 - Вкл/0 - Выкл)
     * @param array $bots - массив с настройками для бота
     *
     * @return int
     */
    public function groupSetting($group_id,$messages,$bots)
    {
        $params = array(
            "group_id" => $group_id,
            "messages" => $messages,
            "access_token" => $this->token,
            "v" => $this->version            
        );
        foreach ($bots as $key => $value) {
            $params[$key] = $value;
        }
        $method = "groups.setSettings";
        $result = $this->request($method,$params);
        return $result["response"];
    }

    /**
     * Возвращает настройки прав для ключа доступа сообщества.
     *
     * @return array
     */  
    public function getTokenPermissions()
    {
        $params = array(
            "access_token" => $this->token,
            "v" => $this->version            
        );
        $method = "groups.getTokenPermissions";
        $result = $this->request($method,$params);
        return $result;
    }

    /**
     * Включает статус «онлайн» в сообществе.
     *
     * @param int $group_id - ID сообщества
     *
     * @return int
     */  
    public function enableOnline($group_id)
    {
        $params = array(
            "group_id" => $group_id,
            "access_token" => $this->token,
            "v" => $this->version            
        );
        $method = "groups.enableOnline";
        $result = $this->request($method,$params);
        return $result["response"];
    }

    /**
     * Выключает статус «онлайн» в сообществе.
     *
     * @param int $group_id - ID сообщества
     *
     * @return int
     */  
    public function disableOnline($group_id)
    {
        $params = array(
            "group_id" => $group_id,
            "access_token" => $this->token,
            "v" => $this->version            
        );
        $method = "groups.disableOnline";
        $result = $this->request($method,$params);
        return $result["response"];
    }

    /**
     * Получает информацию о статусе «онлайн» в сообществе.
     *
     * @param int $group_id - ID сообщества
     *
     * @return $array
     */  
    public function getOnlineStatus($group_id)
    {
        $params = array(
            "group_id" => $group_id,
            "access_token" => $this->token,
            "v" => $this->version            
        );
        $method = "groups.getOnlineStatus";
        $result = $this->request($method,$params);
        return $result;
    }
}
