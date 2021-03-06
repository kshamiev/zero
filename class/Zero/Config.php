<?php

/**
 * The configuration of systems and applications in general.
 *
 * @package Component
 * @author Konstantin Shamiev aka ilosa <konstantin@shamiev.ru>
 * @date 2015-01-01
 */
class Zero_Config
{
    /**
     * The path to the php Interpreter
     *
     * @var string
     */
    public $Site_PathPhp = '';

    /**
     * Site name (of the project)
     *
     * @var string
     */
    public $Site_AccessLogin = '';

    /**
     * Site name (of the project)
     *
     * @var string
     */
    public $Site_AccessPassword = '';

    /**
     * Site name (of the project)
     *
     * @var string
     */
    public $Site_Name = '';

    /**
     * Email the site (by default)
     *
     * @var string
     */
    public $Site_Email = '';

    /**
     * Timeout online users status
     *
     * @var integer
     */
    public $Site_UsersTimeoutOnline = 600;

    /**
     * Using a caching system
     *
     * @var bool
     */
    public $Site_IsCache = false;

    /**
     * Флаг Parsing the presentation templates
     *
     * @var bool
     */
    public $Site_TemplateParsing = true;

    /**
     * Default language
     *
     * @var string
     */
    public $Site_Language = '';

    /**
     * Languages
     *
     * @var array
     */
    public $Site_Languages = [];

    /**
     * Protocol
     *
     * @var string
     */
    public $Site_Protocol = 'http';

    /**
     * Default language
     *
     * @var string
     */
    public $Site_Domain = '';

    /**
     * Default language
     *
     * @var string
     */
    public $Site_DomainAssets = '';

    /**
     * Default language
     *
     * @var string
     */
    public $Site_DomainUpload = '';

    /**
     * Default language
     *
     * @var string
     */
    public $Site_DomainAlias = '';

    /**
     * Default language
     *
     * @var string
     */
    public $Site_DomainSub = '';

    /**
     * Использование БД
     *
     * @var bool
     */
    public $Site_UseDB = false;

    /**
     * Токен сессии пользователя
     *
     * @var string
     */
    public $Site_Token = 'i09u9Maf6l6sr7Um0m8A3u0r9i55m3il';

    /**
     * Maintenance ip access (для всех остальных будет показана страница заглушка)
     *
     * @var array
     */
    public $Site_MaintenanceIp = [];

    /**
     * Список разрешенных ip адресов для работы
     *
     * @var array
     */
    public $Site_AccessAllowIp = [];

    /**
     * Number of items per page
     *
     * @var int
     */
    public $Site_PageItem = 10;

    /**
     * The range of visible pages
     *
     * @var int
     */
    public $Site_PageStep = 11;

    /**
     * Реквизиты доступа к внешним источникам
     *
     * @var array
     */
    public $AccessOutside = [];

    /**
     * Access for DB (Mysql)
     *
     * @var array
     */
    public $Db = [];

    /**
     * Number of items per page
     *
     * @var string
     */
    public $Mail_Host = '';

    /**
     * Number of items per page
     *
     * @var string
     */
    public $Mail_Port = 25;

    /**
     * Number of items per page
     *
     * @var string
     */
    public $Mail_Username = '';

    /**
     * Number of items per page
     *
     * @var string
     */
    public $Mail_Password = '';

    /**
     * Number of items per page
     *
     * @var string
     */
    public $Mail_RetryCnt = 10;

    /**
     * Number of items per page
     *
     * @var string
     */
    public $Mail_ApiSend = '';

    /**
     * Number of items per page
     *
     * @var string
     */
    public $Mail_ApiQueue = '';

    /**
     * Number of items per page
     *
     * @var string
     */
    public $Mail_CharSet = '';

    /**
     * Monitoring. Fatal errors
     *
     * @var bool
     */
    public $Log_Profile_Error = true;

    /**
     * Monitoring. Warning
     *
     * @var bool
     */
    public $Log_Profile_Warning = true;

    /**
     * Monitoring. Warning
     *
     * @var bool
     */
    public $Log_Profile_Notice = true;

    /**
     * Monitoring. User action
     *
     * @var bool
     */
    public $Log_Profile_Action = true;

    /**
     * Monitoring. Work the application as a whole
     *
     * @var bool
     */
    public $Log_Profile_Sql = true;

    /**
     * Monitoring. Work the application as a whole
     *
     * @var bool
     */
    public $Log_Profile_Application = true;

    /**
     * Output File
     *
     * @var bool
     */
    public $Log_Output_File = true;

    /**
     * Output Display
     *
     * @var bool
     */
    public $Log_Output_Display = true;

    /**
     * Servers Memcache
     *
     * @var array
     */
    public $Memcache = [];

    /**
     * IP the source address of the request
     *
     * @var string
     */
    public $Ip = '';

    /**
     * Хранилище объектов конфигурации приложения
     *
     * @var array
     */
    private $config = [];

    /**
     * Загруженная конфигурация из файла
     *
     * @var array
     */
    private $configLoad = [];

    /**
     * Configuration
     */
    public function __construct()
    {
        if ( !file_exists($path = ZERO_PATH_SITE . "/config.php") )
            if ( !file_exists($path = ZERO_PATH_APPLICATION . "/config.php") )
                if ( !file_exists($path = ZERO_PATH_APP . "/config.php") )
                    die('Конфигурационный файл не найден: ' . $path);

        $Config = require $path;
        $this->configLoad = $Config;

        // IP the source address of the request
        if ( isset($_SERVER["HTTP_X_FORWARDED_FOR"]) )
            $this->Ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        else if ( isset($_SERVER["REMOTE_ADDR"]) )
            $this->Ip = $_SERVER["REMOTE_ADDR"];

        if ( !is_dir(ZERO_PATH_EXCHANGE) )
            if ( !mkdir(ZERO_PATH_EXCHANGE, 0777, true) )
                die('path "exchange": "' . ZERO_PATH_EXCHANGE . '" not create');

        if ( !is_dir(ZERO_PATH_CACHE) )
            if ( !mkdir(ZERO_PATH_CACHE, 0777, true) )
                die('path "cache": "' . ZERO_PATH_CACHE . '" not create');

        if ( !is_dir(ZERO_PATH_LOG) )
            if ( !mkdir(ZERO_PATH_LOG, 0777, true) )
                die('logs path: "' . ZERO_PATH_LOG . '" not create');

        // The path to the php Interpreter
        $this->Site_PathPhp = $Config['Site']['PathPhp'];

        // The path to the php Interpreter
        $this->Site_AccessLogin = $Config['Site']['AccessLogin'];
        // File storage sessions
        $this->Site_AccessPassword = $Config['Site']['AccessPassword'];
        // Site name (of the project)
        $this->Site_Name = $Config['Site']['Name'];
        // Email the site (by default)
        $this->Site_Email = $Config['Site']['Email'];
        // Timeout online users status
        $this->Site_UsersTimeoutOnline = $Config['Site']['UsersTimeoutOnline'];
        // Using a caching system
        $this->Site_IsCache = $Config['Site']['IsCache'];
        // Parsing the presentation templates
        $this->Site_TemplateParsing = $Config['Site']['TemplateParsing'];
        //  Default language
        $this->Site_Language = $Config['Site']['Language'];
        // Languages
        $this->Site_Languages = $Config['Site']['Languages'];
        //  Protocol
        if ( isset($Config['Site']['Protocol']) )
            $this->Site_Protocol = $Config['Site']['Protocol'];
        //
        $this->Site_Domain = $Config['Site']['Domain'];
        if ( $Config['Site']['DomainAssets'] )
            $this->Site_DomainAssets = $Config['Site']['DomainAssets'];
        else
            $this->Site_DomainAssets = $this->Site_Domain;
        //
        if ( $Config['Site']['DomainUpload'] )
            $this->Site_DomainUpload = $Config['Site']['DomainUpload'];
        else
            $this->Site_DomainUpload = $this->Site_Domain;
        //
        if ( isset($_SERVER["HTTP_HOST"]) )
            $this->Site_DomainAlias = $_SERVER["HTTP_HOST"];
        else
            $this->Site_DomainAlias = $Config['Site']['Domain'];
        //  Absolute system host a website.
        $this->Site_DomainSub = explode('.', $this->Site_Domain)[0];
        if ( isset($_SERVER['HTTP_HOST']) )
        {
            $arr = explode('.', strtolower($_SERVER['HTTP_HOST']));
            if ( 2 < count($arr) )
            {
                $this->Site_DomainSub = $arr[0];
            }
        }
        //
        $this->Site_UseDB = $Config['Site']['UseDB'];
        //
        if ( isset($Config['Site']['Token']) && $Config['Site']['Token'] )
            $this->Site_Token = $Config['Site']['Token'];
        // Timezone
        if ( isset($Config['Site']['TimeZone']) )
            date_default_timezone_set($Config['Site']['TimeZone']);
        else
            date_default_timezone_set('Europe/Moscow');
        // Разаработческий режи
        if ( isset($Config['Site']['MaintenanceIp']) && is_array($Config['Site']['MaintenanceIp']) )
            $this->Site_MaintenanceIp = array_keys($Config['Site']['MaintenanceIp']);
        // Безопасность
        if ( isset($Config['Site']['AccessAllowIp']) && is_array($Config['Site']['AccessAllowIp']) )
            $this->Site_AccessAllowIp = array_keys($Config['Site']['AccessAllowIp']);

        //  Number of items per page
        $this->Site_PageItem = $Config['Site']['PageItem'];
        //  The range of visible pages
        $this->Site_PageStep = $Config['Site']['PageStep'];

        // Безопасность
        if ( isset($Config['Site']['AccessAllowIp']) && is_array($Config['Site']['AccessAllowIp']) )
            $this->Site_AccessAllowIp = array_keys($Config['Site']['AccessAllowIp']);

        // Реквизиты доступа к внешним источникам
        if ( isset($Config['AccessOutside']) && is_array($Config['AccessOutside']) )
            $this->AccessOutside = $Config['AccessOutside'];

        // Access for DB (Mysql)
        $this->Db = $Config['Db'];

        // Настройки почты
        $this->Mail_Host = $Config['Mail']['Host'];
        $this->Mail_Port = $Config['Mail']['Port'];
        $this->Mail_Username = $Config['Mail']['Username'];
        $this->Mail_Password = $Config['Mail']['Password'];
        $this->Mail_RetryCnt = $Config['Mail']['RetryCnt'];
        $this->Mail_ApiSend = $Config['Mail']['ApiSend'];
        $this->Mail_ApiQueue = $Config['Mail']['ApiQueue'];
        $this->Mail_CharSet = $Config['Mail']['CharSet'];

        // Monitoring. Fatal errors
        $this->Log_Profile_Error = $Config['Log']['Profile']['Error'];
        // Monitoring. Warning
        $this->Log_Profile_Warning = $Config['Log']['Profile']['Warning'];
        // Monitoring. Warning
        $this->Log_Profile_Notice = $Config['Log']['Profile']['Notice'];
        // Monitoring. User action
        $this->Log_Profile_Action = $Config['Log']['Profile']['Action'];
        // Monitoring. User action
        $this->Log_Profile_Sql = $Config['Log']['Profile']['Sql'];
        // Monitoring. Work the application as a whole
        $this->Log_Profile_Application = $Config['Log']['Profile']['Application'];
        // Output File
        $this->Log_Output_File = $Config['Log']['Output']['File'];
        // Output Display
        $this->Log_Output_Display = $Config['Log']['Output']['Display'];

        // Servers Memcache
        $this->Memcache = $Config['Memcache'];

        // Setting php
        set_time_limit(3600);
        setlocale(LC_CTYPE, 'ru_RU.UTF-8');
        setlocale(LC_COLLATE, 'ru_RU.UTF-8');
        // ini_set('display_errors', 0);
        // ini_set('display_startup_errors', 0);
        ini_set('log_errors', true);
        ini_set('error_log', ZERO_PATH_LOG . '/error_php.log');
        ini_set('magic_quotes_gpc', 0);
        // error_reporting(-1);

        //  Storage sessions
        if ( !session_id() )
            if ( 0 < count($Config['Memcache']['Session']) )
            {
                ini_set('session.save_handler', 'memcache');
                ini_set('session.save_path', $Config['Memcache']['Session'][0]);
            }
            else
            {
                ini_set('session.save_handler', 'files');
                $path = ini_get('session.save_path');
                if ( $path && !is_dir($path) )
                    if ( !mkdir($path, 0777, true) )
                        die('session path: "' . $path . '" not exists');
            }
    }

    /**
     * Получение абстрактных пользовательских конфигураций приложеня
     *
     * @param string $prop
     * @return object конфигурация
     * @throws Exception
     */
    public function __get($prop)
    {
        //  Personal`ny`i` ili algoritmichny`i` getter
        if ( method_exists($this, $method = 'Get_' . $prop) )
            return $this->$method();
        else
        {
            if ( empty($this->config[$prop]) )
            {
                $class = 'Site_Config_' . $prop;
                if ( !Zero_App::Autoload($class) )
                    throw new Exception('Not Found Class: ' . $class, 409);
                $this->config[$prop] = new $class($this->configLoad[$prop]);
            }
            return $this->config[$prop];
        }
    }
}
