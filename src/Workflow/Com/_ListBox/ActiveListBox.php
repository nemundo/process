<?php


namespace Nemundo\Process\Workflow\Com\ListBox;


use Nemundo\Package\Bootstrap\FormElement\BootstrapListBox;
use Nemundo\Process\Workflow\Parameter\ActiveParameter;

class ActiveListBox extends BootstrapListBox
{

    protected function loadContainer()
    {
        $this->name = (new ActiveParameter())->getParameterName();
    }


    public function getContent()
    {

        $this->label = 'Active/Inactive';
        $this->emptyValueAsDefault = false;

        $this->addItem(1, 'Active Items');
        $this->addItem(2, 'Deleted Items');
        $this->addItem(3, 'All Items');

        return parent::getContent();

    }

}