<?php


namespace Nemundo\Process\Workflow\Com\Container;


use Nemundo\Admin\Com\Widget\AdminWidget;
use Nemundo\Process\Content\Com\Container\AbstractParentContainer;
use Nemundo\Process\Workflow\Content\Item\Process\WorkflowItem;
use Nemundo\Process\Workflow\Content\Process\WorkflowProcess;
use Nemundo\Process\Workflow\Content\Status\AbstractProcessStatus;

class WorkflowStreamContainer extends AbstractParentContainer  //WorkflowContainer
{

    public function getContent()
    {

            foreach ((new WorkflowProcess($this->parentId))->getChild() as $logRow) {

            /** @var AbstractProcessStatus $status */
            $status = $logRow->contentType->getContentType();

            //if ($status->showLog) {

                if ($status->hasView()) {

                $widget = new AdminWidget($this);
                $widget->widgetTitle =$logRow->subject . ' ' . $logRow->user->displayName . ' ' . $logRow->dateTime->getShortDateTimeLeadingZeroFormat();

                if ($status->hasView()) {
                    $view = $status->getView($widget);
                    $view->dataId = $logRow->id;
                }
                }
            //}

        }

        return parent::getContent();

    }

}