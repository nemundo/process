<?php


namespace Nemundo\Process\Com\Menu;


use Nemundo\Core\Type\Number\YesNo;
use Nemundo\Html\Block\Div;
use Nemundo\Html\Container\AbstractHtmlContainer;
use Nemundo\Html\Inline\Span;
use Nemundo\Process\Item\WorkflowItem;
use Nemundo\Process\Parameter\StatusParameter;
use Nemundo\Process\Process\AbstractProcess;
use Nemundo\Process\Status\AbstractStatus;
use Nemundo\Web\Site\AbstractSite;
use Nemundo\Workflow\Com\Menu\MenuItem;
use Nemundo\Workflow\Com\Menu\StatusMenu;


class ProcessMenuOld extends AbstractHtmlContainer
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

        $workflowClosed = false;

        if ($this->workflowId !== null) {
            $workflowBuilder = new WorkflowItem($this->workflowId);
            $workflowRow = $workflowBuilder->getWorkflowRow();
            $workflowClosed = $workflowRow->workflowClosed;

            if ($workflowClosed) {
                $this->disableMenu = true;
            }

        }


        $div = new Div($this);
        $div->content = 'Workflow Id: '.$this->workflowId;

        $div = new Div($this);
        $div->content = 'Workflow Id: '. (new YesNo($workflowClosed))->getText();


        $menu = new StatusMenu($this);

        $formStatusId = null;
        if ($this->formStatus !== null) {
            $formStatusId = $this->formStatus->id;
        }

        foreach ($this->process->getProcessStatusList() as $status) {

            if ($status->showMenu) {

                $menuItem = new MenuItem();
                $menuItem->label = $status->label;
                $menuItem->site = clone($this->site);
                $menuItem->site->addParameter(new StatusParameter($status->id));

                if ($formStatusId === $status->id) {
                    $menuItem->active = true;
                } else {

                    if (!$this->currentWorkflowStatusFound && !$status->editable) {
                        $menuItem->linked = false;
                    }

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


                if ($this->workflowStatus->getNextStatus() !== null) {
                    if ($this->workflowStatus->getNextStatus()->id == $status->id) {
                        $menuItem->linked = true;
                    }
                }


                if ($this->disableMenu) {
                    $menuItem->linked = false;
                }

                //User Check
                $menu->addMenuItem($menuItem);

            }


            $nextStatus = $this->workflowStatus->getNextStatus();

            if (!$workflowClosed) {
                if ($nextStatus !== null) {

                    if ($nextStatus->id == $status->id) {

                        if ($this->workflowId !== null) {

                            foreach ($this->workflowStatus->getMenuStatus() as $menuStatus) {

                                $nextMenuItem = new MenuItem();

                                $span = new Span();
                                $span->addCssClass('ml-3');
                                $span->content = $menuStatus->label;

                                $nextMenuItem->label = $span->getContent();

                                $nextMenuItem->site = clone($this->site);
                                $nextMenuItem->site->addParameter(new StatusParameter($menuStatus->id));

                                if ($formStatusId === $menuStatus->id) {
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
            }


            //if ($this->workflowStatus->nextStatusClass !== null) {
            //    if ($this->workflowStatus->nextStatusClass->id == $status->id) {
            if ($nextStatus !== null) {
                if ($nextStatus->id == $status->id) {
                    $this->currentWorkflowStatusFound = true;
                }
            }

        }
        return parent::getContent();

    }

}