<?php


namespace Nemundo\Process\Workflow\Content\View;


use Nemundo\Process\Content\View\AbstractContentView;
use Nemundo\Process\Workflow\Com\Table\BaseWorkflowTable;

class WorkflowBaseView extends AbstractContentView
{

    public function getContent()
    {

        $base = new BaseWorkflowTable($this);
        $base->workflowId = $this->dataId;


        return parent::getContent(); // TODO: Change the autogenerated stub
    }

}