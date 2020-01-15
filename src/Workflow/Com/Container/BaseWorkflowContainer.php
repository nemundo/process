<?php


namespace Nemundo\Process\Workflow\Com\Container;


use Nemundo\Process\Content\Com\Container\AbstractParentContainer;
use Nemundo\Process\Template\Container\FileParentContainer;
use Nemundo\Process\Workflow\Com\Table\BaseWorkflowTable;
use Nemundo\Process\Workflow\Com\Table\SourceTable;

class BaseWorkflowContainer extends AbstractParentContainer
{

    public function getContent()
    {

        $base = new BaseWorkflowTable($this);
        $base->workflowId = $this->parentId;

        /*$table = new SourceTable($this);
        $table->workflowId = $this->workflowId;*/

        //$view =new DocumentParentContainer($this);
        //$view->parentId = $this->workflowId;

        // todo container


        return parent::getContent();

    }

}