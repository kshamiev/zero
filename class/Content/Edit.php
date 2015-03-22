<?php
/**
 * Changing the content blocks page.
 *
 * @package Zero.Content.Admin
 * @author Konstantin Shamiev aka ilosa <konstantin@phpzero.com>
 * @date 2015.01.01
 */
class Zero_Content_Edit extends Zero_Crud_Edit
{
    /**
     * The table stores the objects handled by this controller.
     *
     * @var string
     */
    protected $ModelName = 'Zero_Content';

    /**
     * Template view
     *
     * @var string
     */
    protected $Template = 'Zero_Crud_Edit';
}