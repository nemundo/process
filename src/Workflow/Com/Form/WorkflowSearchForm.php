<?php


namespace Nemundo\Process\Workflow\Com\Form;


use Nemundo\Com\FormBuilder\SearchForm;
use Nemundo\Package\Bootstrap\Form\BootstrapFormRow;
use Nemundo\Process\Workflow\Com\ListBox\ProcessListBox;
use Nemundo\User\Com\ListBox\UserListBox;

class WorkflowSearchForm extends SearchForm
{

    public function getContent()
    {

        $formRow = new BootstrapFormRow($this);

        $list = new ProcessListBox($formRow);
        $list->submitOnChange = true;
        $list->searchMode = true;

       $list=  new UserListBox($formRow);
       $list->label='Assignment';
        $list->submitOnChange = true;
        $list->searchMode = true;


        return parent::getContent();

    }

}