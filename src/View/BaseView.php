<?php


namespace Nemundo\Process\View;


use Nemundo\Process\Com\Table\BaseWorkflowTable;

class BaseView extends AbstractStatusView
{

    public function getContent()
    {

        $base = new BaseWorkflowTable($this);
        $base->workflowId = $this->workflowId;

        $view = new WorkflowDocumentView($this);
        $view->workflowId = $this->workflowId;

        return parent::getContent();

    }

}