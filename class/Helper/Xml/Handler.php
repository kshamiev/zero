<?php
/**
 * Класс реализующий обрабчики нод XML объекта.
 *
 * Для обработки нужной ноды создется метод-обработчик с соответсвующим ей именем.
 * К примеру: &lt;item ...&gt; ... &lt;/item&gt; = function Item()
 * ! Регистр и там и там не имеет значения !
 * Сулжит в первую очередь для поточной обработки нод.
 * Во время парсинга файла очень большего размера.
 * После обработки он не добавляется в общее дерево объекта XML
 *
 * @package Helper.Xml
 * @author Konstantin Shamiev aka ilosa <konstantin@shamiev.ru>
 * @version 2014.09.21
 */
class Helper_Xml_Handler
{
    /**
     * Конструткор
     */
    public function __construct()
    {
    }

    /**
     * Обработчик ноды одноименной методу (без учета регистра)
     *
     * @param Helper_Xml_Object $Xml
     * @return bool
     */
    public function Example(Helper_Xml_Object $Xml)
    {
        //  print '$Xml<pre>'; print_r($Xml); print '</pre>';
        return true;
    }

    /**
     * Деструктор
     */
    public function __destruct()
    {
    }
}
