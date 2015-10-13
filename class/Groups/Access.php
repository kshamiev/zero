<?php
/**
 * Controller. Management of access rights.
 *
 * @package Zero.Groups.Admin
 * @author Konstantin Shamiev aka ilosa <konstantin@shamiev.ru>
 * @date 2015.01.01
 */
class Zero_Groups_Access extends Zero_Controller
{

    /**
     * The table stores the objects handled by this controller.
     *
     * @var string
     */
    protected $ModelName = 'Zero_Groups';

    /**
     * Template view
     *
     * @var string
     */
    protected $ViewName = __CLASS__;

    /**
     * Vy`polnenie dei`stvii`
     *
     * @return Zero_View or string
     */
    public function Action_Default()
    {
        $this->Chunk_Init();
        $this->Chunk_View();
        return $this->View->Fetch($this->ViewTplOutString);
    }

    /**
     * Preservation of the rights of access
     *
     * @return boolean flag stop execute of the next chunk
     */
    public function Action_Save()
    {
        $this->Chunk_Init();
        $this->Chunk_Save();
        $this->Chunk_View();
        return $this->View->Fetch($this->ViewTplOutString);
    }

    /**
     * Copying permissions
     *
     * @return boolean flag stop execute of the next chunk
     */
    public function Action_Copy()
    {
        $this->Chunk_Init();
        $this->Chunk_Copy();
        $this->Chunk_View();
        return $this->View->Fetch($this->ViewTplOutString);
    }

    /**
     * Initialization of the stack chunks and input parameters
     *
     * @return boolean flag stop execute of the next chunk
     */
    protected function Chunk_Init()
    {
        $this->Params['obj_parent_prop'] = 'Groups_ID';
        $this->Params['obj_parent_name'] = '';
        if ( isset($_GET['pid']) )
            $this->Params['obj_parent_id'] = $_GET['pid'];
        else if ( empty($this->Params['obj_parent_id']) )
            $this->Params['obj_parent_id'] = 0;
        $this->View = new Zero_View($this->ViewName);
        $this->Model = Zero_Model::Makes($this->ModelName, $this->Params['obj_parent_id'], true);
    }

    /**
     * Create views.
     *
     * @throws Exception
     */
    protected function Chunk_View()
    {
        $Section = Zero_Model::Makes('Zero_Section');
        $section_list = $Section->AR->Select_Tree('ID, Name, Controller, Url, IsAuthorized');
        foreach ($section_list as $id => $row)
        {
            if ( 'no' == $row['IsAuthorized'] || '' == $row['Controller'] )
            {
                unset($section_list[$id]);
                continue;
            }
            //  read from the controllers
            $method_list = [];
            try
            {
                $reflection = new ReflectionClass($row['Controller']);
            } catch ( Exception $e )
            {
                throw new Exception($e->getMessage(), -1);
            }
            foreach ($reflection->getMethods(ReflectionMethod::IS_PUBLIC) as $method)
            {
                $name = $method->getName();
                if ( 'Action_Default' == $name )
                    continue;
                //                    $index = substr($name, strpos($name, '_') + 1);
                $arr = explode('_', $name);
                if ( $arr[0] == 'Action' )
                {
                    array_shift($arr);
                    $index = join('_', $arr);
                    $method_list[$index] = Zero_I18n::Controller($row['Controller'], $name);
                }
            }
            $section_list[$id]['action_list_all'] = $method_list;
            $section_list[$id]['action_list_all_count'] = count($method_list) + 1;

            $Action = Zero_Model::Makes('Zero_Action');
            $Action->AR->Sql_Where('Section_ID', '=', $id);
            $Action->AR->Sql_Where('Groups_ID', '=', $this->Params['obj_parent_id']);
            $Action->AR->Sql_Order('Action', 'ASC');
            $action_list = $Action->AR->Select_Array_Index('Action');
            $section_list[$id]['action_list'] = $action_list;
        }

        $this->View->Assign('Section', Zero_App::$Section);
        $this->View->Assign('section_list', $section_list);
        $this->View->Assign('Params', $this->Params);
        $this->View->Assign('Action', Zero_App::$Section->Get_Action_List());

        $groups_list = Zero_DB::Select_List_Index("SELECT ID, Name FROM Groups WHERE ID != {$this->Params['obj_parent_id']} ORDER BY Name ASC");
        $this->View->Assign('Groups', $this->Model);
        $this->View->Assign('groups_list', $groups_list);
        $this->View->Assign('pid', $this->Params['obj_parent_id']);
    }

    /**
     * Preservation of the rights of access
     *
     * @return boolean flag stop execute of the next chunk
     */
    protected function Chunk_Save()
    {
        foreach ($_REQUEST['RoleAccessSection'] as $section_id => $access)
        {
            Zero_DB::Update("DELETE FROM Action WHERE Groups_ID = {$this->Params['obj_parent_id']} AND Section_ID = {$section_id}");
            //  Access to the section for the group
            if ( 'access' == $access )
            {
                $Action = Zero_Model::Makes('Zero_Action');
                $Action->Section_ID = $section_id;
                $Action->Groups_ID = $this->Params['obj_parent_id'];
                $Action->Action = 'Default';
                $Action->Save();
            }
            else
                continue;
            //  access to the controller actions
            if ( isset($_REQUEST['RoleAccessAction'][$section_id]) )
            {
                foreach ($_REQUEST['RoleAccessAction'][$section_id] as $action => $panel)
                {
                    if ( 'access' == $panel )
                    {
                        $Action = Zero_Model::Makes('Zero_Action');
                        $Action->Section_ID = $section_id;
                        $Action->Groups_ID = $this->Params['obj_parent_id'];
                        $Action->Action = $action;
                        $Action->Save();
                    }
                }
            }
        }
        //  Reset Cache
        $Model = Zero_Model::Makes('Zero_Groups', $this->Params['obj_parent_id']);
        $Model->Cache->Reset();
        return $this->SetMessage(0, 'Сохранено');
    }

    /**
     * Copying permissions
     *
     * @return boolean flag stop execute of the next chunk
     */
    protected function Chunk_Copy()
    {
        Zero_DB::Update("DELETE FROM Action WHERE Groups_ID = {$_REQUEST['obj_id']}");
        $sql = "
        INSERT INTO `Action`
          (
          `Section_ID`,
          `Groups_ID`,
          `Action`
        ) SELECT
          `Section_ID`,
          {$_REQUEST['obj_id']},
          `Action`
        FROM `Action`
        WHERE
          `Groups_ID` = {$this->Params['obj_parent_id']}
        ";
        Zero_DB::Update($sql);
        return $this->SetMessage(0, 'Скопировано');
    }
}