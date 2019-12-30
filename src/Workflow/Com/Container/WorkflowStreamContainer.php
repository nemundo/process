<?php


namespace Nemundo\Process\Workflow\Com\Container;


use Nemundo\Admin\Com\Widget\AdminWidget;
use Nemundo\Process\Content\Com\Container\AbstractParentContainer;
use Nemundo\Process\Workflow\Content\Item\Process\WorkflowItem;
use Nemundo\Process\Workflow\Content\Status\AbstractProcessStatus;

class WorkflowStreamContainer extends AbstractParentContainer  //WorkflowContainer
{

    public function getContent()
    {

        foreach ((new WorkflowItem($this->parentId))->getChild() as $logRow) {

            /** @var AbstractProcessStatus $status */
            $status = $logRow->contentType->getContentType();

            if ($status->showLog) {

                $widget = new AdminWidget($this);
//            $widget->widgetTitle = $status->getLogText($logRow->dataId) . ' ' . $logRow->user->displayName . ' ' . $logRow->dateTime->getShortDateTimeWithSecondLeadingZeroFormat();


                //$widget->widgetTitle =$status->getSubject($logRow->id) . ' ' . $logRow->user->displayName . ' ' . $logRow->dateTime->getShortDateTimeLeadingZeroFormat();

                $widget->widgetTitle =$logRow->subject . ' ' . $logRow->user->displayName . ' ' . $logRow->dateTime->getShortDateTimeLeadingZeroFormat();


                if ($status->hasView()) {
                    $view = $status->getView($widget);
                    $view->dataId = $logRow->id;  //dataId;
                }

            }

        }

        return parent::getContent();

    }

}