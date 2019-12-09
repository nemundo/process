<?php


namespace Nemundo\Process\Com\Container;


use Nemundo\Admin\Com\Widget\AdminWidget;
use Nemundo\Html\Container\AbstractHtmlContainer;
use Nemundo\Html\Paragraph\Paragraph;
use Nemundo\Process\Data\WorkflowLog\WorkflowLogReader;
use Nemundo\Process\Item\WorkflowItem;

class WorkflowStreamContainer extends AbstractHtmlContainer
{

    public $workflowId;

    public function getContent()
    {

        /*
        $reader = new WorkflowLogReader();
        $reader->model->loadStatus();
        $reader->model->loadUser();
        $reader->filter->andEqual($reader->model->workflowId, $this->workflowId);
        */

        foreach ((new WorkflowItem($this->workflowId))->getWorkflowLog() as $logRow) {

            $status = $logRow->status->getStatus();


            $widget = new AdminWidget($this);
//            $widget->widgetTitle = $status->getLogText($logRow->dataId) . ' ' . $logRow->user->displayName . ' ' . $logRow->dateTime->getShortDateTimeWithSecondLeadingZeroFormat();
            $widget->widgetTitle =  $logRow->user->displayName . ' ' . $logRow->dateTime->getShortDateTimeLeadingZeroFormat();

            $p = new Paragraph($widget);
            $p->content = $status->getLogText($logRow->dataId) ;


            if ($status->hasView()) {

                $view = $status->getView($widget);
                $view->dataId = $logRow->dataId;

            }

        }

        return parent::getContent();

    }


}