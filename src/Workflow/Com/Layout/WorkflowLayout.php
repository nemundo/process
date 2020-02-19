<?php


namespace Nemundo\Process\Workflow\Com\Layout;


use Nemundo\Package\Bootstrap\Layout\BootstrapThreeColumnLayout;

class WorkflowLayout extends BootstrapThreeColumnLayout
{
    
    protected function loadContainer()
    {

        parent::loadContainer();

        $this->col1->columnWidth = 3;
        $this->col2->columnWidth = 5;
        $this->col3->columnWidth = 4;
    
    }



}