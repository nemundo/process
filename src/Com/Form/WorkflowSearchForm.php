<?php


namespace Nemundo\Process\Com\Form;


use Nemundo\Com\FormBuilder\SearchForm;
use Nemundo\Package\Bootstrap\Form\BootstrapFormRow;
use Nemundo\Process\Com\ListBox\ProcessListBox;

class WorkflowSearchForm extends SearchForm
{

    public function getContent()
    {

        $formRow = new BootstrapFormRow($this);

        $list = new ProcessListBox($formRow);
        $list->submitOnChange=true;
        $list->searchItem=true;

        return parent::getContent();

    }

}