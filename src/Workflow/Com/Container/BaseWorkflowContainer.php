<?php


namespace Nemundo\Process\Workflow\Com\Container;


use Nemundo\Process\Template\Container\DocumentParentContainer;
use Nemundo\Process\Workflow\Com\Table\BaseWorkflowTable;
use Nemundo\Process\Workflow\Com\Table\SourceTable;

class BaseWorkflowContainer extends AbstractWorkflowContainer
{

    public function getContent()
    {

        $base = new BaseWorkflowTable($this);
        $base->workflowId = $this->workflowId;

        /*$table = new SourceTable($this);
        $table->workflowId = $this->workflowId;*/

        $view =new DocumentParentContainer($this);
        $view->parentId = $this->workflowId;

        // todo container


        return parent::getContent();

    }

}