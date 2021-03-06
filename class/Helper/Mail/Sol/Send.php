<?php

/**
 * Отправка очереди почтовых сообщений
 *
 * @package Helper.Mail
 * @author Konstantin Shamiev aka ilosa <konstantin@shamiev.ru>
 * @date 2015.01.01
 */
class Helper_Mail_Sol_Send
{
    /**
     * Отправка очереди почтовых сообщений
     *
     * Отправка 100 очередных неотправленных сообщений.
     * Запускается каждые 10 минут.
     * Прозводит 10 попыток отправки.
     */
    public function Action_Default()
    {
        Helper_Mail::SendConsole();
    }
}