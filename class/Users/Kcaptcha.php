<?php
/**
 * Controller. Generation cAPTCHA.
 *
 * @package Zero.Users.Login
 * @author Konstantin Shamiev aka ilosa <konstantin@phpzero.com>
 * @date 2015.01.01
 */
class Zero_Users_Kcaptcha extends Zero_Controller
{
    /**
     * Create views.
     *
     * @return boolean flag stop execute of the next chunk
     */
    public function Action_Default()
    {
        include_once ZERO_PATH_LIBRARY . '/kcaptcha/kcaptcha.php';
        $Captcha = new KCAPTCHA();
        Zero_App::$Users->Keystring = $Captcha->getKeyString();
        exit;
    }
}