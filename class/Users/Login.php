<?php
/**
 * Controller. User authentication.
 *
 * @package Zero.Users.Login
 * @author Konstantin Shamiev aka ilosa <konstantin@phpzero.com>
 * @date 2015.01.01
 */
class Zero_Users_Login extends Zero_Controller
{
    /**
     * Vy`polnenie dei`stvii`
     *
     * @return boolean flag stop execute of the next chunk
     */
    public function Action_Default()
    {
        $this->Chunk_Init();
        $this->View->Assign('Users', Zero_App::$Users);
        return $this->View;
    }

    /**
     * User authentication.
     *
     * @return boolean flag stop execute of the next chunk
     */
    public function Action_Login()
    {
        $this->Chunk_Init();
        $this->Chunk_Login();
        $this->View->Assign('Users', Zero_App::$Users);
        return $this->View;
    }

    /**
     * Recovery of user details.
     *
     * @return boolean flag stop execute of the next chunk
     */
    public function Action_Reminder()
    {
        $this->Chunk_Init();
        $this->Chunk_Reminder();
        $this->View->Assign('Users', Zero_App::$Users);
        return $this->View;
    }

    /**
     * User exit.
     *
     */
    public function Action_Logout()
    {
        Zero_Session::Unset_Instance();
        session_unset();
        session_destroy();
        setcookie('i09u9Maf6l6sr7Um0m8A3u0r9i55m3il', null, 0, '/');
        Zero_App::ResponseRedirect(ZERO_HTTP);
    }

    /**
     * Initialization of the stack chunks and input parameters
     *
     * @return boolean flag stop execute of the next chunk
     */
    protected function Chunk_Init()
    {
        if ( 0 < Zero_App::$Users->ID )
        {
            Zero_App::ResponseRedirect('/admin');
        }
        $this->Model = Zero_Model::Make('Www_Users');
        $this->View = new Zero_View(get_class($this));
        if ( !Zero_App::$Users->UrlRedirect )
        {
            if ( 1 < count(explode($_SERVER["HTTP_HOST"], ZERO_HTTPH)) )
                Zero_App::$Users->UrlRedirect = ZERO_HTTPH;
            else
                Zero_App::$Users->UrlRedirect = '/';
        }
        Zero_App::$Users->Factory_Set();
    }

    /**
     * User authentication.
     *
     * @return boolean flag stop execute of the next chunk
     */
    protected function Chunk_Login()
    {
        // Инициализация чанков
        if ( !$_REQUEST['Login'] || !$_REQUEST['Password'] )
            return true;

        $Users = Zero_Model::Make('Www_Users');
        /* @var $Users Zero_Users */
        $Users->AR->Sql_Where('Login', '=', $_REQUEST['Login']);
        $Users->AR->Select('*');

        //  Check
        if ( 0 == $Users->ID )
            return $this->Set_Message("Error_Registration", 1);
        else if ( $Users->Password != md5($_REQUEST['Password']) )
            return $this->Set_Message("Error_Password", 1);
        else if ( !$Users->Groups_ID )
            return $this->Set_Message("Error_Groups", 1);

        if ( isset($_REQUEST['Memory']) && $_REQUEST['Memory'] )
        {
            $Users->Token = crypt($_REQUEST['Password'], crypt($_REQUEST['Password']));
            setcookie('i09u9Maf6l6sr7Um0m8A3u0r9i55m3il', $Users->Token, time() + 2592000, '/');
        }
        else
        {
            $Users->Token = '';
            setcookie('i09u9Maf6l6sr7Um0m8A3u0r9i55m3il', null, 0, '/');
        }
        $Users->IsOnline = 'yes';
        $Users->DateOnline = date('Y-m-d H:i:s');
        $Users->AR->Update();

        $url_history = Zero_App::$Users->UrlRedirect;

        Zero_App::$Users = $Users;
        Zero_App::$Users->Factory_Set();
        Zero_App::ResponseRedirect($url_history);
        return false;
    }

    /**
     * Recovery of user details.
     *
     * @return boolean flag stop execute of the next chunk
     */
    protected function Chunk_Reminder()
    {
        $this->Model->VL->Validate($_REQUEST['Users'], 'reminder');
        if ( 0 < count($this->Model->VL->Get_Errors()) )
        {
            $this->View->Assign('Error_Validator', $this->Model->VL->Get_Errors());
            return $this->Set_Message('Error_Validate', 1, false);
        }

        $this->Model->AR->Sql_Where('Email', '=', $_REQUEST['Users']['Email']);
        $this->Model->AR->Select('ID, Name, Login');

        $password = substr(md5(uniqid(mt_rand())), 0, 10);
        $this->Model->Password = md5($password);
        $this->Model->AR->Update();

        $subject = "Reminder access details " . HTTP;
        $View = new Zero_View('Zero_Users_ReminderMail');
        $View->Assign('Users', $this->Model);
        $View->Assign('password', $password);
        $message = $View->Fetch();

        $from = ['Email' => Zero_App::$Config->Site_Email, 'Name' => Zero_App::$Config->Site_Name];
        $to = [['Email' => $this->Model->Email, 'Name' => $this->Model->Name]];
        $reply = $from;
        Zero_Lib_Mail::Send($from, $to, $reply, $subject, $message);

        $this->Model = Zero_Model::Make('Www_Users');

        return $this->Set_Message("Reminder", 0);
    }
}