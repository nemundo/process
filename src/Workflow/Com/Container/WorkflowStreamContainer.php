<?php


namespace Nemundo\Process\Workflow\Com\Container;


use Nemundo\Admin\Com\Widget\AdminWidget;
use Nemundo\Com\Html\Hyperlink\SiteHyperlink;
use Nemundo\Com\Html\Listing\UnorderedList;
use Nemundo\Html\Block\Div;
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

                $div = new Div($widget);

                /*
                $ul =new UnorderedList($div);*/

                if ($status->hasViewSite()) {
                //$hyperlink = new SiteHyperlink($ul);
                    $hyperlink = new SiteHyperlink($div);
                    $hyperlink->site = $status->getViewSite();
                }

                /*
                $ul->addText('message to');
                $ul->addText('remove');
*/


                if ($status->hasView()) {
                    $view = $status->getView($widget);
                    $view->dataId = $logRow->dataId;
                }
            }

        }

        return parent::getContent();

    }

}