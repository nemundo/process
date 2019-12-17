<?php


namespace Nemundo\Process\View;


use Nemundo\Admin\Com\Table\AdminTable;
use Nemundo\Admin\Com\Title\AdminSubtitle;
use Nemundo\Com\TableBuilder\TableRow;
use Nemundo\Process\Com\Table\BaseWorkflowTable;
use Nemundo\Process\Com\Table\SourceTable;
use Nemundo\Process\Content\Data\Content\ContentReader;
use Nemundo\Process\Workflow\Com\Container\AbstractWorkflowContainer;

class BaseView extends AbstractWorkflowContainer  // AbstractStatusView
{

    public function getContent()
    {

        $base = new BaseWorkflowTable($this);
        $base->workflowId = $this->workflowId;

        $table = new SourceTable($this);
        $table->workflowId= $this->workflowId;


        /*
        $subtitle = new AdminSubtitle($this);
        $subtitle->content = 'Quelle';

        $table = new AdminTable($this);

        $reader = new ContentReader();
        $reader->filter->andEqual($reader->model->dataId,$this->workflowId);
        foreach ($reader->getData() as $contentRow) {

            $contentType = $contentRow->contentType->getContentType();
            //$subject = $contentType->getSubject($contentRow->dataId);

            $row = new TableRow($table);
            $row->addSite($contentType->getViewSite($contentRow->dataId));

        }*/



        $view = new WorkflowDocumentView($this);
        $view->workflowId = $this->workflowId;

        return parent::getContent();

    }

}