<?php


namespace Nemundo\Process\Com\ListBox;


use Nemundo\Package\Bootstrap\FormElement\BootstrapListBox;
use Nemundo\Process\Data\Process\ProcessReader;
use Nemundo\Process\Parameter\ProcessParameter;

class ProcessListBox extends BootstrapListBox
{

    public function getContent()
    {

        $this->label = 'Process';
        $this->name = (new ProcessParameter())->parameterName;

        $reader = new ProcessReader();
        $reader->addOrder($reader->model->process);
        foreach ($reader->getData() as $processRow) {
            $this->addItem($processRow->id, $processRow->process);
        }

        return parent::getContent();

    }

}