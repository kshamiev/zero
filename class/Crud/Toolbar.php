<?php
/**
 * Controller. Formation of abstract panel controllers actions.
 *
 * @package Zero.Crud
 * @author Konstantin Shamiev aka ilosa <konstantin@phpzero.com>
 * @date 2015.01.01
 */
class Zero_Crud_Toolbar extends Zero_Controller
{
    /**
     * Create views.
     *
     * @return boolean flag stop execute of the next chunk
     */
    public function Action_Default()
    {
        $this->View = new Zero_View();
        if ( isset($this->Params['Template']) )
            $this->View->Template_Add($this->Params['Template']);
        else
            $this->View->Template_Add(Zero_App::$Section->Controller . 'Toolbar');
        $this->View->Template_Add('Zero_Crud_Toolbar');
        foreach ($this->Params as $prop => $value)
        {
            $this->View->Assign($prop, $value);
        }
        return $this->View;
    }
}