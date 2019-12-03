<?php


namespace Nemundo\Process\Com\Layout;


use Nemundo\Package\Bootstrap\Layout\BootstrapThreeColumnLayout;

class WorkflowLayout extends BootstrapThreeColumnLayout
{
    
    protected function loadContainer()
    {

        parent::loadContainer();

        $this->col1->columnWidth = 2;
        $this->col2->columnWidth = 4;
        $this->col3->columnWidth = 6;
    
    }



}