<?php


namespace Nemundo\Process\Com\Menu;


use Nemundo\Html\Container\AbstractHtmlContainer;
use Nemundo\Html\Inline\Span;
use Nemundo\Process\Item\WorkflowItem;
use Nemundo\Process\Parameter\StatusParameter;
use Nemundo\Process\Process\AbstractProcess;
use Nemundo\Process\Status\AbstractStatus;
use Nemundo\Web\Site\AbstractSite;
use Nemundo\Workflow\Com\Menu\MenuItem;
use Nemundo\Workflow\Com\Menu\StatusMenu;


class ProcessMenu extends AbstractHtmlContainer
{

    /**
     * @var string
     */
    public $workflowId;

    /**
     * @var AbstractSite
     */
    public $site;

    /**
     * @var AbstractProcess
     */
    public $process;

    /**
     * @var AbstractStatus
     */
    public $formStatus;

    /**
     * @var AbstractStatus
     */
    public $workflowStatus;


    public $disableMenu = false;


    /**
     * @var AbstractStatus
     */
    //public $nextStatus;

    /**
     * @var bool
     */
    private $currentWorkflowStatusFound = false;


    public function getContent()
    {


        /*
        $p = new Paragraph($this);
        $p->content = 'Workflwo Status: '.$this->workflowStatus->label;

        $p = new Paragraph($this);
if ($this->workflowStatus->nextStatus !== null) {
        $p->content = 'Next Status: '.$this->workflowStatus->nextStatus->label;
} else {
    $p->content ='No Next Status';
}

$ul = new UnorderedList($this);
foreach ($this->process->getProcessStatusList() as $status) {
    $ul->addText($status->label);
    //(new Debug())->write($status);

}*/


        // $nextStatus = $this->workflowStatus->getNextStatus()


        $workflowClosed = false;

        if ($this->workflowId !== null) {
            $workflowBuilder = new WorkflowItem($this->workflowId);
            $workflowRow = $workflowBuilder->getWorkflowRow();
            $workflowClosed = $workflowRow->workflowClosed;
        }

        $menu = new StatusMenu($this);

        $formStatusId = null;
        if ($this->formStatus !== null) {
            $formStatusId = $this->formStatus->id;
        }


        foreach ($this->process->getProcessStatusList() as $status) {
            //foreach ($this->process->getStatusList() as $status) {

            if ($status->showMenu) {

                $menuItem = new MenuItem();
                $menuItem->label = $status->label;
                $menuItem->site = clone($this->site);
                $menuItem->site->addParameter(new StatusParameter($status->id));

                if ($formStatusId === $status->id) {
                    $menuItem->active = true;
                }

                if ($this->currentWorkflowStatusFound) {
                    $menuItem->linked = false;
                }

                if ($workflowClosed && !$status->activeAfterWorkflowClosed) {
                    $menuItem->active = false;
                    $menuItem->linked = false;
                }

                if ($this->workflowId == null) {
                    $menuItem->linked = false;
                }

                if ($this->disableMenu) {
                    $menuItem->linked = false;
                }

                //User Check
                $menu->addMenuItem($menuItem);

            }

            // Next Status

            //if ($menuItem->active) {

            if ($this->workflowStatus->nextStatus !== null) {

                if ($this->workflowStatus->nextStatus->id == $status->id) {

                    if ($this->workflowId !== null) {

                        foreach ($this->workflowStatus->getMenuStatus() as $nextStatus) {

                            $nextMenuItem = new MenuItem();
                            // $nextMenuItem->subMenu=true;
                            //$nextMenuItem->label = HtmlCharacter::NON_BREAKING_SPACE . HtmlCharacter::NON_BREAKING_SPACE . HtmlCharacter::NON_BREAKING_SPACE . $nextStatus->label;

                            $span = new Span();
                            $span->addCssClass('ml-3');
                            $span->content = $nextStatus->label;

                            $nextMenuItem->label = $span->getContent();

                            $nextMenuItem->site = clone($this->site);
                            $nextMenuItem->site->addParameter(new StatusParameter($nextStatus->id));

                            if ($formStatusId === $nextStatus->id) {
                                $nextMenuItem->active = true;
                            }

                            if ($this->disableMenu) {
                                $menuItem->linked = false;
                            }

                            $menu->addMenuItem($nextMenuItem);

                        }

                    }

                }
            }


            if ($this->workflowStatus->nextStatus !== null) {
                if ($this->workflowStatus->nextStatus->id == $status->id) {
                    $this->currentWorkflowStatusFound = true;
                }
            }

        }


        //if ($this->formStatus->showSubMenu) {

        /*$menu->addEmptyMenu();

        if ($this->workflowId !== null) {


            foreach ($this->process->getSubStatusList() as $status) {

                $menuItem = new MenuItem();
                $menuItem->label = $status->label;
                $menuItem->site = clone($this->site);
                $menuItem->site->addParameter(new StatusParameter($status->id));


                if ($formStatusId === $status->id) {
                    $menuItem->active = true;
                }


                if ($this->workflowId == null) {
                    $menuItem->linked = false;
                }

                if ($workflowClosed && !$status->activeAfterWorkflowClosed) {
                    $menuItem->active = false;
                    $menuItem->linked = false;
                }

                $menu->addMenuItem($menuItem);

            }

        }*/

        return parent::getContent();

    }

}