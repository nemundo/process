<?php


namespace Nemundo\Process\Com\Container;


use Nemundo\Admin\Com\Widget\AdminWidget;
use Nemundo\Html\Paragraph\Paragraph;
use Nemundo\Process\Item\WorkflowItem;

class WorkflowStreamContainer extends AbstractWorkflowContainer
{

    public function getContent()
    {

        foreach ((new WorkflowItem($this->workflowId))->getWorkflowLog() as $logRow) {

            $status = $logRow->status->getStatus();

            if ($status->showLog) {

                $widget = new AdminWidget($this);
//            $widget->widgetTitle = $status->getLogText($logRow->dataId) . ' ' . $logRow->user->displayName . ' ' . $logRow->dateTime->getShortDateTimeWithSecondLeadingZeroFormat();
                $widget->widgetTitle = $logRow->user->displayName . ' ' . $logRow->dateTime->getShortDateTimeLeadingZeroFormat();

                $p = new Paragraph($widget);
                $p->content = $status->getLogText($logRow->dataId);

                if ($status->hasView()) {
                    $view = $status->getView($widget);
                    $view->dataId = $logRow->dataId;
                    $view->workflowId= $this->workflowId;
                }

            }

        }

        return parent::getContent();

    }

}