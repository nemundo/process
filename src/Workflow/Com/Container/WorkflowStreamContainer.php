<?php


namespace Nemundo\Process\Workflow\Com\Container;


use Nemundo\Admin\Com\Widget\AdminWidget;
use Nemundo\Process\Content\Com\Container\AbstractParentContainer;
use Nemundo\Process\Workflow\Content\Status\AbstractProcessStatus;

class WorkflowStreamContainer extends AbstractParentContainer  //WorkflowContainer
{

    public function getContent()
    {


        foreach ($this->contentType->getChild() as $logRow) {

            /** @var AbstractProcessStatus $status */
            $status = $logRow->getContentType();

            if ($status->hasView()) {

                $widget = new AdminWidget($this);
                $widget->widgetTitle = $status->getSubject() . ' ' . $logRow->user->displayName . ' ' . $logRow->dateTime->getShortDateTimeLeadingZeroFormat();

                if ($status->hasView()) {
                    $view = $status->getView($widget);
                    $view->dataId = $logRow->dataId;
                }
            }

        }

        return parent::getContent();

    }

}