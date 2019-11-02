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
}