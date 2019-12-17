<?php


namespace Nemundo\Process\Workflow\Com\Container;


use Nemundo\Admin\Com\Widget\AdminWidget;
use Nemundo\Process\Workflow\Content\Item\Process\ProcessItem;
use Nemundo\Process\Workflow\Content\Item\WorkflowItem;
use Nemundo\Process\Workflow\Content\Status\AbstractStatus;

class WorkflowStreamContainer extends AbstractWorkflowContainer
{

    public function getContent()
    {

        foreach ((new ProcessItem($this->workflowId))->getChildContent() as $logRow) {

            //$status = $logRow->status->getStatus();

            /** @var AbstractStatus $status */
            $status = $logRow->contentType->getContentType();

            if ($status->showLog) {

                $widget = new AdminWidget($this);
//            $widget->widgetTitle = $status->getLogText($logRow->dataId) . ' ' . $logRow->user->displayName . ' ' . $logRow->dateTime->getShortDateTimeWithSecondLeadingZeroFormat();
                $widget->widgetTitle = $logRow->userCreated->displayName . ' ' . $logRow->dateTimeCreated->getShortDateTimeLeadingZeroFormat();

                //$p = new Paragraph($widget);
                //$p->content = $status->getSubject($logRow->dataId);

                if ($status->hasView()) {
                    $view = $status->getView($widget);
                    $view->dataId = $logRow->dataId;

                    //$view->workflowId= $this->workflowId;
                }

            }

        }

        return parent::getContent();

    }

}