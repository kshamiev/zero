<?php

/**
 * Controllers.
 *
 * @package Zero
 * @author Konstantin Shamiev aka ilosa <konstantin@shamiev.ru>
 * @date 2016.06.07
 *
 * @property string $Name
 * @property string $Controller
 * @property string $Typ
 * @property string $Url
 * @property string $Minute
 * @property string $Hour
 * @property string $Day
 * @property string $Month
 * @property string $Week
 * @property integer $IsActiv
 * @property string $IsAuthorized
 */
class Zero_Controllers extends Zero_Model
{
    /**
     * The table stores the objects this model
     *
     * @var string
     */
    protected $Source = 'Controllers';

	/**
	 * Action List
	 *
	 * @var array
	 */
	private $_Action_List = null;

    /**
     * Базовая конфигурация свойств модели
     *
     * Настройки свойств наследуются остальными конфигурациоными методами
     * Каждое свойство имеет следующие базовые настройки:
     * - 'AliasDB'=> 'z.PropName'       - Реальное название свойства (поля) в БД
     * - 'DB'=> 'T, I, F, E, S, D, B'   - Суффикс проверочного метода и косвенного типа хранения в БД
     * - 'IsNull'=> 'YES, NO'           - Разрешено ли значение NULL
     * - 'Default'=> mixed              - Значение по умолчанию
     * - 'Form'=> string                - Форма предстваления свйоства в виджетах и вьюхах
     *
     * @see Zero_Engine
     * - 'Comment' => string            - Комментарий свойства (пользуйтесь системой перевода i18n)
     *
     * @param Zero_Controllers $Model The exact working model
     * @param string $scenario Сценарий свойств
     * @return array
     */
    protected static function Config_Prop($Model, $scenario = '')
    {
        return [
            'ID' => [
				'AliasDB' => 'z.ID',
				'DB' => 'ID',
				'IsNull' => 'NO',
				'Default' => '',
				'Form' => '',
			],
			'Name' => [
				'AliasDB' => 'z.Name',
				'DB' => 'T',
				'IsNull' => 'NO',
				'Default' => '',
				'Form' => 'Text',
			],
			'Controller' => [
				'AliasDB' => 'z.Controller',
				'DB' => 'T',
				'IsNull' => 'NO',
				'Default' => '',
				'Form' => 'Text',
			],
			'Typ' => [
				'AliasDB' => 'z.Typ',
				'DB' => 'E',
				'IsNull' => 'NO',
				'Default' => 'Web',
				'Form' => 'Radio',
			],
			'Url' => [
				'AliasDB' => 'z.Url',
				'DB' => 'T',
				'IsNull' => 'YES',
				'Default' => '',
				'Form' => 'Text',
			],
			'Minute' => [
				'AliasDB' => 'z.Minute',
				'DB' => 'T',
				'IsNull' => 'YES',
				'Default' => '',
				'Form' => 'Text',
			],
			'Hour' => [
				'AliasDB' => 'z.Hour',
				'DB' => 'T',
				'IsNull' => 'YES',
				'Default' => '',
				'Form' => 'Text',
			],
			'Day' => [
				'AliasDB' => 'z.Day',
				'DB' => 'T',
				'IsNull' => 'YES',
				'Default' => '',
				'Form' => 'Text',
			],
			'Month' => [
				'AliasDB' => 'z.Month',
				'DB' => 'T',
				'IsNull' => 'YES',
				'Default' => '',
				'Form' => 'Text',
			],
			'Week' => [
				'AliasDB' => 'z.Week',
				'DB' => 'T',
				'IsNull' => 'YES',
				'Default' => '',
				'Form' => 'Text',
			],
			'IsActive' => [
				'AliasDB' => 'z.IsActive',
				'DB' => 'I',
				'IsNull' => 'NO',
				'Default' => '0',
				'Form' => 'Check',
			],
			'IsAuthorized' => [
				'AliasDB' => 'z.IsAuthorized',
				'DB' => 'E',
				'IsNull' => 'NO',
				'Default' => 'no',
				'Form' => 'Radio'
			],
        ];
    }

    /**
     * Dynamic configuration properties for the filter
     *
     * Каждое свойство имеет следующие настройки:
     * - 'AliasDB'=> 'z.PropName'       - Реальное название свойства (поля) в БД
     * - 'DB'=> 'T, I, F, E, S, D, B'   - Суффикс проверочного метода и косвенного типа хранения в БД
     * - 'AR'=> bool                    - Использовать ли в запросах к БД
     * - 'Visible'=> bool               - Видимость фильтра в виджите или вьюхе
     * - 'Form'=> 'Select, Radio, Checkbox, Null, Check, Datetime, Link' - Форма предстваления свйоства в виджетах и вьюхах
     * - 'List'=> array                 - Варианты значений (пользуйтесь системой перевода i18n)
     * - 'Comment' => string            - Комментарий свойства (пользуйтесь системой перевода i18n)
     *
     * @param Zero_Controllers $Model The exact working model
     * @param string $scenario Сценарий свойств
     * @return array
     */
    protected static function Config_Filter($Model, $scenario = '')
    {
        return [
            'ID' => ['Visible' => true, 'AR' => true],
			'Name' => ['Visible' => true, 'AR' => true],
			'Controller' => ['Visible' => true, 'AR' => true],
			'Typ' => ['Visible' => true, 'AR' => true],
			'Url' => ['Visible' => true, 'AR' => true],
			'Minute' => ['Visible' => true, 'AR' => true],
			'Hour' => ['Visible' => true, 'AR' => true],
			'Day' => ['Visible' => true, 'AR' => true],
			'Month' => ['Visible' => true, 'AR' => true],
			'Week' => ['Visible' => true, 'AR' => true],
			'IsActive' => ['Visible' => true, 'AR' => true],
			'IsAuthorized' => ['Visible' => true, 'AR' => true],
        ];
    }

    /**
     * Dynamic configuration properties for the Grid
     *
     * Каждое свойство имеет следующие настройки:
     * - 'AliasDB'=> 'z.PropName'       - Реальное название свойства (поля) в БД
     * - 'Comment' => string            - Комментарий свойства (пользуйтесь системой перевода i18n)
     *
     * @param Zero_Controllers $Model The exact working model
     * @param string $scenario Сценарий свойств
     * @return array
     */
    protected static function Config_Grid($Model, $scenario = '')
    {
        return [
            'ID' => [],
			'Name' => [],
			'Url' => [],
			'Minute' => [],
			'Hour' => [],
			'Day' => [],
			'Month' => [],
			'Week' => [],
        ];
    }

    /**
     * Dynamic configuration properties for the form
     *
     * Каждое свойство имеет следующие настройки:
     * - 'IsNull'=> 'YES, NO'           - Разрешено ли значение NULL
     * - 'Form'=> string                - Форма предстваления свйоства в виджетах и вьюхах (смотри Zero_Engine)
     * - 'Comment' => string            - Комментарий свойства (пользуйтесь системой перевода i18n)
     *
     * @param Zero_Controllers $Model The exact working model
     * @param string $scenario Сценарий свойств
     * @return array
     */
    protected static function Config_Form($Model, $scenario = '')
    {
        return [
			'Name' => [],
			'Controller' => [],
			'Url' => [],
			'Minute' => [],
			'Hour' => [],
			'Day' => [],
			'Month' => [],
			'Week' => [],
			'IsActive' => [],
			'IsAuthorized' => [],
			'Typ' => [],
        ];
    }

    /**
     * Формирование from части запроса к БД
     * May be removed
     *
     * @param array $params параметры контроллера
     * @return string
     */
    public function AR_From($params)
    {
        $this->AR->Sql_From("FROM {$this->Source} as z");
    }

    /**
     * Создание и удаление связи многие ко многим
     *
     * @param $id
     * @return bool
     */
    public function DB_Cross_TableName($id, $flag = true)
    {
        if ( $flag )
        {
            $sql = "
            INSERT INTO TableName
              FieldName1, FieldName2
            VALUES
              {$id}, {$this->ID}
            ";
            return Zero_DB::Insert($sql);
        }
        else
        {
            $sqk_where = '';
            if ( 0 < $id )
                $sqk_where = "AND FieldName2 = {$id}";
            $sql = "DELETE FROM TableName WHERE FieldName1 = {$this->ID} {$sqk_where}";
            return Zero_DB::Update($sql);
        }
    }

    /**
     * Sample. The total initial validation properties
     *
     * @param array $data verifiable data array
     * @param string $scenario scenario validation
     * @return array
     */
    public function Validate_Before($data, $scenario)
    {
        return $data;
    }

    /**
     * Sample. The validation property
     * May be removed
     *
     * @param mixed $value value to check and set
     * @param string $scenario scenario validation
     * @return string
     */
    public function VL_PropertyName($value, $scenario)
    {
        $this->PropertyName = $value;
        return '';
    }

    /**
     * Sample. Filter for property.
     * May be removed
     *
     * @return array
     */
    public function FL_PropertyName()
    {
        return [23 => 'Value'];
    }

	/**
	 * Getting a controller actions with regard to the rights section.
	 *
	 * @return array ist of actions controllers section
	 * @throws Exception
	 */
	public function Get_Action_List()
	{
		if ( 0 == $this->ID )
			return [];
		else if ( !is_null($this->_Action_List) )
			return $this->_Action_List;

		$controllerName = $this->Controller;
		$index_cache = 'ControllerList_' . Zero_App::$Users->Groups_ID . '_' . $controllerName;
		if ( false !== $this->_Action_List = $this->Cache->Get($index_cache) )
			return $this->_Action_List;

		$this->_Action_List = [];
		if ( Zero_App::$Config->Site_UseDB && 'yes' == $this->IsAuthorized && 1 < Zero_App::$Users->Groups_ID )
		{
			$Model = Zero_Model::Makes('Zero_Action');
			$Model->AR->Sql_Where('Controllers_ID', '=', $this->ID);
			$Model->AR->Sql_Where('Groups_ID', '=', Zero_App::$Users->Groups_ID);
			$this->_Action_List = $Model->AR->Select_Array_Index('Action');
			foreach ($this->_Action_List as $action => $row)
			{
				$this->_Action_List[$action] = ['Name' => Zero_I18n::Controller($controllerName, 'Action_' . $action)];
			}
		}
		else if ( '' != $controllerName )
		{
			if ( false == Zero_App::Autoload($controllerName) )
				throw new Exception('Класс не найден: ' . $controllerName, -1);

			$reflection = new ReflectionClass($controllerName);
			foreach ($reflection->getMethods(ReflectionMethod::IS_PUBLIC) as $method)
			{
				$name = $method->getName();
				$arr = explode('_', $name);
				if ( $arr[0] == 'Action' )
				{
					array_shift($arr);
					$index = join('_', $arr);
					$this->_Action_List[$index] = ['Name' => Zero_I18n::Controller($controllerName, $name)];
				}
			}
		}
		Zero_Cache::Set_Link('Groups', Zero_App::$Users->Groups_ID);
		$this->Cache->Set($index_cache, $this->_Action_List);
		return $this->_Action_List;
	}

    /**
     * Динамический фабричный метод длиа создании объекта через фабрику и инстанс.
     */
    protected function Init()
    {
		// Поиск в БД
		if ( Zero_App::$Config->Site_UseDB )
		{
			$sql = "SELECT * FROM Controllers WHERE Url = " . Zero_DB::EscT(ZERO_URL);
			$row = Zero_DB::Select_Row($sql);
			$this->Set_Props($row);
		}
		// Поиск в программе
		else
		{
			foreach (Zero_App::$Config->Modules as $module)
			{
				$index = 'route' . Zero_App::Get_Mode();
				if ( !isset($module[$index]) || !is_object($module[$index]) )
					continue;
				$route = $module[$index];
				if ( isset($route->Route[ZERO_URL]) )
				{
					$route = $route->Route[ZERO_URL];
					$route['ID'] = -1;
					$route['Url'] = ZERO_URL;
					$route['Typ'] = Zero_App::MODE_API;
					if ( empty($route['Name']) )
						$route['Name'] = $route['Controller'];
					if ( empty($route['IsAuthorized']) )
						$route['IsAuthorized'] = 'no';
					if ( empty($route['IsActive']) )
						$route['IsActive'] = 1;
					$this->Set_Props($route);
					Zero_Cache::Set_Data($index, $route);
					break;
				}
			}
		}
    }

    /**
     * Фабрика по созданию объектов.
     *
     * @param integer $id идентификатор объекта
     * @param bool $flagLoad флаг полной загрузки объекта
     * @return Zero_Controllers
     */
    public static function Make($id = 0, $flagLoad = false)
    {
        return new self($id, $flagLoad);
    }

    /**
     * Фабрика по созданию объектов.
     *
     * Сохраниаетсиа в {$тис->_Инстанcе}
     *
     * @param integer $id идентификатор объекта
     * @param bool $flagLoad флаг полной загрузки объекта
     * @return Zero_Controllers
     */
    public static function Instance($id = 0, $flagLoad = false)
    {
        $index = __CLASS__ . (0 < $id ? '_' . $id : '');
        if ( !isset(self::$Instance[$index]) )
        {
            $result = self::Make($id, $flagLoad);
            $result->Init();
            self::$Instance[$index] = $result;
        }
        return self::$Instance[$index];
    }

    /**
     * Фабрика по созданию объектов.
     *
     * Работает через сессию (Zero_Session).
     * Индекс имя класса
     *
     * @param integer $id идентификатор объекта
     * @param bool $flagLoad флаг полной загрузки объекта
     * @return Zero_Controllers
     */
    public static function Factor($id = 0, $flagLoad = false)
    {
        if ( !$result = Zero_Session::Get(__CLASS__) )
        {
            $result = self::Make($id, $flagLoad);
            $result->Init();
            Zero_Session::Set(__CLASS__, $result);
        }
        return $result;
    }
}