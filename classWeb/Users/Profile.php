<?php

/**
 * Controller. User Profile.
 *
 * @package Zero.Controller.Users
 * @author Konstantin Shamiev aka ilosa <konstantin@phpzero.com>
 * @version $Id$
 * @link http://www.phpzero.com/
 * @copyright <PHP_ZERO_COPYRIGHT>
 * @license http://www.phpzero.com/license/
 */
class Zero_Web_Users_Profile extends Zero_Controller
{
    /**
     * Обрабатываемая модель
     *
     * @var Zero_Users
     */
    protected $Model = null;

    /**
     * Vy`polnenie dei`stvii`
     *
     * @return Zero_View
     */
    public function Action_Default()
    {
        $this->Chunk_Init();
        $this->Chunk_View();
        return $this->View;
    }

    /**
     * Vy`polnenie dei`stvii`
     *
     * @return Zero_View
     */
    public function Action_Profile()
    {
        $this->Chunk_Init();
        $this->Chunk_Profile();
        $this->Chunk_View();
        return $this->View;
    }

    /**
     * Changing a user profile.
     *
     * @return boolean flag stop execute of the next chunk
     */
    protected function Chunk_Profile()
    {
        $this->Model->VL->Validate($_REQUEST['Users'], get_class($this));
        if ( 0 < count($this->Model->VL->Get_Errors()) )
        {
            $this->View->Assign('Error_Validator', $this->Model->VL->Get_Errors());
            $this->SetMessage(5300);
            return false;
        }
        $this->Model->Save();
        Zero_App::$Users = $this->Model;
        Zero_App::$Users->Factory_Set();
        $this->SetMessage(2300);
        return true;
    }

    /**
     * Create views.
     *
     * @return bool
     */
    protected function Chunk_Init()
    {
        if ( 0 == Zero_App::$Users->ID )
        {
            Zero_App::ResponseRedirect('/');
        }
        $this->View = new Zero_View(get_class($this));
        $this->View->Assign('Error_Validator', []);
        $this->Model = Zero_Users::Make(Zero_App::$Users->ID, true);
        return true;
    }

    /**
     * Create views.
     *
     * @return Zero_View or string
     */
    protected function Chunk_View()
    {
        $this->View->Assign('Users', $this->Model);
        return true;
    }
}