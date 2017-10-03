<?php

/**
 * <Comment>
 *
 * {plugin "Zero_Section_SeoTag" view="Zero_Section_SeoTag"}
 *
 * @package <Package>.<Subpackage>
 * @author Konstantin Shamiev aka ilosa <konstantin@shamiev.ru>
 * @date <Date>
 */
class Zero_Controller_Sample extends Zero_Controller
{
    //// Пример контроллера для WEB
    /**
     * Контроллер по умолчанию.
     *
     * @return string
     */
    public function Action_Default()
    {
        $this->Chunk_Init();
        $this->Chunk_View();
        return $this->View;
    }

    //// Пример контроллера для API
    /**
     * Какой-то контроллер
     *
     * @sample /api/v1/sample?param=value...
     *
     * @return boolean flag статус выполнения
     */
    public function Action_GET()
    {
        Zero_App::ResponseJson200($_REQUEST, 0, []);
        return true;
    }

    /**
     * Какой-то контроллер
     *
     * @sample /api/v1/sample?param=value...
     *
     * @return boolean flag статус выполнения
     */
    public function Action_PUT()
    {
        Zero_App::ResponseJson200($_REQUEST, 0, []);
        return true;
    }

    /**
     * Какой-то контроллер
     *
     * @sample /api/v1/sample?param=value...
     *
     * @return boolean flag статус выполнения
     */
    public function Action_POST()
    {
        Zero_App::ResponseJson200($_REQUEST, 0, []);
        return true;
    }

    /**
     * Какой-то контроллер
     *
     * @sample /api/v1/sample?param=value...
     *
     * @return boolean flag статус выполнения
     */
    public function Action_DELETE()
    {
        Zero_App::ResponseJson200($_REQUEST, 0, []);
        return true;
    }

    /**
     * Опции запроса
     *
     * @return boolean flag статус выполнения
     */
    public function Action_OPTIONS()
    {
        settype($_REQUEST['method'], 'string');
        if ( !$_REQUEST['method'] )
            Zero_App::ResponseJson200(null, 0, ['?method=[GET,POST,PUT,DELETE]']);

        $_REQUEST['method'] = strtolower($_REQUEST['method']);
        switch ( $_REQUEST['method'] )
        {
            case 'get':
                $response = [];
                Zero_App::ResponseJson200($response, 0, ['?']);
                break;
            case 'post':
                $response = [];
                Zero_App::ResponseJson200($response, 0, ['?']);
                break;
            case 'put':
                $response = [];
                Zero_App::ResponseJson200($response, 0, ['?']);
                break;
            case 'delete':
                $response = [];
                Zero_App::ResponseJson200($response, 0, ['?']);
                break;
            default:
                Zero_App::ResponseJson200('метод не реализован');
                break;
        }
        return true;
    }

    //// Пример консольного контроллера
    /**
     * Какой-то контроллер
     *
     * @return boolean flag статус выполнения
     */
    public function Action_OperationName()
    {
        $path = dirname(ZERO_PATH_DATA) . '/temp';
        foreach (glob($path . '/.+') as $file)
        {
            $timeOutMinute = (time() - filemtime($file)) * 60;
            if ( 60 < $timeOutMinute )
                unlink($file);
        }
        return true;
    }

    ////

    /**
     * Фабричный метод по созданию контроллера.
     *
     * @param array $properties входные параметры плагина
     * @return Zero_Controller
     */
    public static function Make($properties = [])
    {
        $Controller = new self();
        foreach ($properties as $property => $value)
        {
            $Controller->Params[$property] = $value;
        }
        return $Controller;
    }

    /**
     * Fabrika po sozdaniiu kontrollerov.
     *
     * Rabotaet cherez sessiiu. Indeks: $class_name
     *
     * @param array $properties vhodny`e parametry` plagina
     * @return Zero_Controller
     */
    public static function Factory($properties = [])
    {
        if ( !$result = Zero_Session::Get(__CLASS__) )
        {
            $result = self::Make($properties);
            Zero_Session::Set(__CLASS__, $result);
        }
        return $result;
    }
}
