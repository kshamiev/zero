<?php

/**
 * Пользователи.
 *
 * @package Zero
 * @author Konstantin Shamiev aka ilosa <konstantin@shamiev.ru>
 * @date 2015-01-01
 *
 * @property integer $Groups_ID
 * @property integer $Users_ID
 * @property string $Name
 * @property string $Login
 * @property string $Password
 * @property string $IsAccess
 * @property string $Email
 * @property string $Phone
 * @property string $Skype
 * @property string $IsCondition
 * @property string $ImgAvatar
 * @property string $IsOnline
 * @property string $DateOnline
 * @property string $Date
 * @property string $Token
 * @property string $TokenNew
 * @property string $Address
 */
class Zero_Users extends Zero_Model
{
    /**
     * The table stores the objects this model
     *
     * @var string
     */
    protected $Source = 'Users';

    /**
     * KCAPTCacheA
     *
     * @var string
     */
    public $Keystring = '';

    /**
     * Usloviia pol`zovatelia.
     * Prava po gorizotali ( na stroki )
     *
     * @var array('Users_ID'=>23, ...)
     */
    private $_Condition = null;

    /**
     * Vremia proshedshee v sekundakh ot nachala e`pohi Unix (TIMESTAMP)
     *
     * @var integer
     */
    public $Timeout = 0;

    /**
     * The configuration properties
     *
     * - 'DB'=> 'T, I, F, E, S, D, B'
     * - 'IsNull'=> 'YES, NO'
     * - 'Default'=> 'mixed'
     * - 'Value'=> [] 'Values ​​for Enum, Set'
     * - 'Comment' = 'PropComment'
     *
     * @param Zero_Model $Model The exact working model
     * @return array
     */
    protected static function Config_Prop($Model, $scenario = '')
    {
        return [
            /*BEG_CONFIG_PROP*/
            'ID' => [
                'AliasDB' => 'z.ID',
                'DB' => 'ID',
                'IsNull' => 'NO',
                'Default' => '',
                'Form' => ''
            ],
            'Groups_ID' => ['AliasDB' => 'z.Groups_ID', 'DB' => 'ID', 'IsNull' => 'YES', 'Default' => '2', 'Form' => 'Link'],
            'Users_ID' => ['AliasDB' => 'z.Users_ID', 'DB' => 'ID', 'IsNull' => 'YES', 'Default' => '', 'Form' => 'Link'],
            'Name' => ['AliasDB' => 'z.Name', 'DB' => 'T', 'IsNull' => 'YES', 'Default' => '', 'Form' => 'Text'],
            'Login' => ['AliasDB' => 'z.Login', 'DB' => 'T', 'IsNull' => 'NO', 'Default' => '', 'Form' => 'Text'],
            'Password' => ['AliasDB' => 'z.Password', 'DB' => 'T', 'IsNull' => 'YES', 'Default' => '', 'Form' => 'Password'],
            'IsAccess' => ['AliasDB' => 'z.IsAccess', 'DB' => 'E', 'IsNull' => 'NO', 'Default' => 'open', 'Form' => 'Radio'],
            'Email' => ['AliasDB' => 'z.Email', 'DB' => 'T', 'IsNull' => 'NO', 'Default' => '', 'Form' => 'Text'],
            'Phone' => ['AliasDB' => 'z.Phone', 'DB' => 'T', 'IsNull' => 'YES', 'Default' => '', 'Form' => 'Text'],
            'Skype' => ['AliasDB' => 'z.Skype', 'DB' => 'T', 'IsNull' => 'YES', 'Default' => '', 'Form' => 'Text'],
            'IsCondition' => ['AliasDB' => 'z.IsCondition', 'DB' => 'E', 'IsNull' => 'NO', 'Default' => 'yes', 'Form' => 'Radio'],
            'ImgAvatar' => ['AliasDB' => 'z.ImgAvatar', 'DB' => 'T', 'IsNull' => 'YES', 'Default' => '', 'Form' => 'Img'],
            'IsOnline' => ['AliasDB' => 'z.IsOnline', 'DB' => 'E', 'IsNull' => 'NO', 'Default' => 'no', 'Form' => 'Readonly'],
            'DateOnline' => ['AliasDB' => 'z.DateOnline', 'DB' => 'T', 'IsNull' => 'YES', 'Default' => '', 'Form' => 'Readonly'],
            'Date' => ['AliasDB' => 'z.Date', 'DB' => 'D', 'IsNull' => 'NO', 'Default' => '', 'Form' => 'Readonly'],
            'Address' => ['AliasDB' => 'z.Address', 'DB' => 'T', 'IsNull' => 'YES', 'Default' => '', 'Form' => 'Textarea'],
            'Token' => ['AliasDB' => 'z.Token', 'DB' => 'T', 'IsNull' => 'YES', 'Default' => '', 'Form' => 'Password'],
            /*END_CONFIG_PROP*/
        ];
    }

    /**
     * Dynamic configuration properties for the filter
     *
     * - 'Filter'=> 'Select, Radio, Checkbox, Datetime, Link, Linkmore, Number, Text, Textarea, Content
     * - 'Search'=> 'Number, Text'
     * - 'Sort'=> false, true
     * - 'Comment' = 'PropComment'
     *
     * @param Zero_Model $Model The exact working model
     * @param string $scenario scenario
     * @return array
     */
    protected static function Config_Filter($Model, $scenario = '')
    {
        return [
            /*BEG_CONFIG_FILTER_PROP*/
            'ID' => ['AR' => true],
            'Name' => ['AR' => true],
            'Groups_ID' => ['AR' => true],
            'Users_ID' => ['AR' => true],
            'IsAccess' => ['AR' => true],
            'IsCondition' => ['AR' => true],
            'IsOnline' => ['AR' => true],
            'Date' => ['Visible' => true, 'AR' => true, 'Form' => 'Datetime'],
            /*END_CONFIG_FILTER_PROP*/
        ];
    }

    /**
     * Dynamic configuration properties for the Grid
     *
     * - 'Grid' = 'AliasName.PropName'
     * - 'Comment' = 'PropComment'
     *
     * @param Zero_Model $Model The exact working model
     * @param string $scenario scenario
     * @return array
     */
    protected static function Config_Grid($Model, $scenario = '')
    {
        return [
            /*BEG_CONFIG_GRID_PROP*/
            'ID' => [],
            'Name' => [],
            'Email' => [],
            /*END_CONFIG_GRID_PROP*/
        ];
    }

    /**
     * Dynamic configuration properties for the form
     *
     * - 'Form'=> [
     *      Number, Text, Select, Radio, Checkbox, Textarea, Date, Time, Datetime, Link,
     *      Hidden, Readonly, Password, File, Filedata, Img, ImgData, Content', Linkmore
     *      ]
     * - 'Comment' = 'PropComment'
     *
     * @param Zero_Model $Model The exact working model
     * @param string $scenario scenario forms
     * @return array
     */
    protected static function Config_Form($Model, $scenario = '')
    {
        if ( 'Zero_Users_Profile' == $scenario )
        {
            return [
                'Name' => [],
                'Password' => [],
                'PasswordR' => ['AliasDB' => 'z.Password', 'DB' => 'T', 'IsNull' => 'YES', 'Default' => '', 'Form' => 'Password'],
                'Email' => [],
                'Phone' => [],
                'Skype' => [],
                'Address' => [],
            ];
        }
        // По умолчанию
        return [
            'Groups_ID' => [],
            'Users_ID' => [],
            'Name' => [],
            'Login' => [],
            'Password' => [],
            'PasswordR' => ['AliasDB' => 'z.Password', 'DB' => 'T', 'IsNull' => 'YES', 'Default' => '', 'Form' => 'Password'],
            'Email' => [],
            'Phone' => [],
            'Skype' => [],
            'Address' => [],
            'Token' => [],
            'Date' => [],
            'DateOnline' => [],
            'IsOnline' => [],
            'IsCondition' => [],
            'IsAccess' => [],
            'ImgAvatar' => [],
        ];
    }

    /**
     * Генерация нового токена
     *
     * @return string - новый токен
     */
    public function Get_TokenNew()
    {
        return crypt($this->Name . $this->Email, crypt($this->Password));
    }

    /**
     * Poluchenie uslovii` pol`zovatelia
     *
     * @return array - massiv uslovii` pol`zovaetia (cliuch svoi`stvo, znachenie uslovie)
     */
    public function Get_Condition()
    {
        if ( is_null($this->_Condition) )
        {
            $this->_Condition = [];
            //  uslovie pol`zovatelia
            if ( 'yes' == $this->IsCondition )
            {
                $this->_Condition['Users_ID'] = Zero_DB::Select_List_Index("SELECT ID, Name FROM Users WHERE Users_ID = {$this->ID}");
                $this->_Condition['Users_ID'][$this->ID] = $this->Name;
            }
        }
        return $this->_Condition;
    }

    /**
     * Initcializatciia onlai`n statusa ne aktivny`kh pol`zovatelei`.
     *
     * Tai`maut ne aktivny`kh pol`zovatelei` 10 minut.
     * V dal`nei`shem e`tot parametr mozhno zavesti v konfiguratciiu sai`ta i regulirovat`.
     *
     * @param integer $seconds Tai`maut v sekundakh po istechenii kotorogo pol`zovatel` schitaetsia pokinuvshim sai`t
     * @return boolean flag stop execute of the next chunk
     */
    public static function DB_Offline($seconds = 600)
    {
        $sql = "UPDATE Users SET IsOnline = 'no', Token = NULL WHERE DateOnline < NOW() - INTERVAL {$seconds} SECOND";
        Zero_DB::Update($sql);
    }

    /**
     * Validatciia logina.
     *
     * @param mixed $value value to check
     * @param string $scenario scenario validation
     * @return string
     */
    public function VL_Login($value, $scenario)
    {
        if ( 0 < $this->ID )
            $this->AR->Sql_Where('ID', '!=', $this->ID);
        $this->AR->Sql_Where('Login', '=', $value);
        $cnt = $this->AR->Select_Count();
        if ( 0 < $cnt )
            return 'Error_Exists';
        $this->Login = $value;
        return '';
    }

    /**
     * Validatciia logina.
     *
     * @param mixed $value value to check
     * @param string $scenario scenario validation
     * @return string
     */
    public function VL_Token($value, $scenario)
    {
        if ( $value )
            $this->Token = md5($value);
        return '';
    }

    /**
     * Validatciia e`lektronnogo pochtovogo adresa.
     *
     * @param mixed $value value to check
     * @param string $scenario scenario validation
     * @return string
     */
    public function VL_Email($value, $scenario)
    {
        if ( !preg_match(Zero_Validator::PATTERN_EMAIL, $value) )
            return 'Error_ValidEmail';
        if ( 'reminder' == $scenario )
        {
            $this->AR->Sql_Where('Email', '=', $value);
            $cnt = $this->AR->Select_Count();
            if ( !$cnt )
                return 'Error_NotRegistration';
        }
        else
        {
            $this->AR->Sql_Where('Email', '=', $value);
            if ( 0 < $this->ID )
                $this->AR->Sql_Where('ID', '!=', $this->ID);
            $cnt = $this->AR->Select_Count();
            if ( 0 < $cnt )
                return 'Error_Exists';
        }
        $this->Email = $value;
        return '';
    }

    /**
     * Validatciia parolia
     *
     * @param mixed $value value to check
     * @param string $scenario scenario validation
     * @return string
     */
    public function VL_Password($value, $scenario)
    {
        if ( !$value )
            return '';
        if ( isset($_REQUEST['Users']['PasswordR']) && $value != $_REQUEST['Users']['PasswordR'] )
            return 'Error_PasswordValid';
        else if ( isset($_REQUEST['User']['PasswordR']) && $value != $_REQUEST['User']['PasswordR'] )
            return 'Error_PasswordValid';
        $this->Password = md5($value);
        return '';
    }

    /**
     * Dppolnitel`naia validatciia parolia
     *
     * @param mixed $value value to check
     * @param string $scenario scenario validation
     * @return string
     */
    public function VL_PasswordR($value, $scenario)
    {
        if ( !$value )
            return '';
        if ( isset($_REQUEST['Users']['Password']) && $value != $_REQUEST['Users']['Password'] )
            return 'Error_PasswordValid';
        else if ( isset($_REQUEST['User']['Password']) && $value != $_REQUEST['User']['Password'] )
            return 'Error_PasswordValid';
        $this->Password = md5($value);
        return '';
    }

    /**
     * Validatciia kontrol`noi` stroki.
     *
     * Zashchita ot botov
     *
     * @param mixed $value value to check
     * @param string $scenario scenario validation
     * @return string
     */
    public function VL_Keystring($value, $scenario)
    {
        if ( Zero_App::$Users->Keystring != $value )
            return 'Error_Keystring';
        return '';
    }

    public function FL_Groups_ID()
    {
        if ( Zero_App::$Users->Groups_ID == 1 )
        {
            $sql = "SELECT ID, Name FROM Groups ORDER BY 2";
        }
        else
        {
            $sql = "SELECT ID, Name FROM Groups WHERE ID != 1 ORDER BY 2";
        }
        return Zero_DB::Select_List_Index($sql);
    }

    /**
     * Загрузка пользователя по его email
     *
     * @param string $email
     */
    public function Load_Email($email)
    {
        $sql = "SELECT * FROM {$this->Source} WHERE Email = " . Zero_DB::EscT($email);
        $row = Zero_DB::Select_Row($sql);
        $this->Set_Props($row);
    }

    /**
     * Загрузка пользователя по его логину
     *
     * @param string $login
     */
    public function Load_Login($login)
    {
        $sql = "SELECT * FROM {$this->Source} WHERE Login = " . Zero_DB::EscT($login);
        $row = Zero_DB::Select_Row($sql);
        $this->Set_Props($row);
    }

    /**
     * Загрузка пользователя по его токену
     *
     * @param string $token
     */
    public function Load_Token($token)
    {
        $sql = "SELECT * FROM {$this->Source} WHERE Token = " . Zero_DB::EscT(md5($token));
        $row = Zero_DB::Select_Row($sql);
        $this->Set_Props($row);
    }

    /**
     * Фабрика по созданию объектов.
     *
     * @param integer $id идентификатор объекта
     * @param bool $flagLoad флаг полной загрузки объекта
     * @return Zero_Users
     */
    public static function Make($id = 0, $flagLoad = false)
    {
        $obj = new Site_Users($id, $flagLoad);
        return $obj;
    }

    /**
     * Фабрика по созданию объектов.
     *
     * Работает через сессию (Zero_Session).
     * Индекс имя класса
     *
     * @param integer $id идентификатор объекта
     * @param bool $flagLoad флаг полной загрузки объекта
     * @return Zero_Users
     */
    public static function Factory($id = 0, $flagLoad = false)
    {
        $index = 'Site_Users' . (0 < $id ? '_' . $id : '');
        if ( !$result = Zero_Session::Get($index) )
        {
            $result = self::Make($id, $flagLoad);
            $result->Groups_ID = 2;
            $result->Login = 'guest';
            Zero_Session::Set($index, $result);
        }
        return $result;
    }
}