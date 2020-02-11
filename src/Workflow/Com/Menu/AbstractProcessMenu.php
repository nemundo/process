<?php


namespace Nemundo\Process\Workflow\Com\Menu;


use Nemundo\Admin\Com\Table\AdminTable;
use Nemundo\Com\Html\Hyperlink\SiteHyperlink;
use Nemundo\Com\TableBuilder\TableRow;
use Nemundo\Html\Container\AbstractContainer;
use Nemundo\Html\Container\AbstractHtmlContainer;
use Nemundo\Html\Formatting\Bold;
use Nemundo\Package\FontAwesome\Icon\ArrowRightIcon;
use Nemundo\Package\FontAwesome\Icon\CheckIcon;
use Nemundo\Process\Workflow\Content\Process\AbstractProcess;
use Nemundo\Process\Workflow\Content\Status\AbstractProcessStatus;
use Nemundo\Process\Workflow\Parameter\StatusParameter;
use Nemundo\Web\Site\AbstractSite;

class AbstractProcessMenu extends AbstractHtmlContainer
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
     * @var AbstractProcessStatus
     */
    public $formStatus;

    /**
     * @var AbstractProcessStatus
     */
    public $workflowStatus;

    /**
     * @var AdminTable
     */
    protected $table;

    /**
     * @var AbstractProcessStatus
     */
    protected $nextStatus;

    /**
     * @var bool
     */
    protected $workflowStatusFound = false;

    /**
     * @var bool
     */
    protected $workflowExist;

    /**
     * @var bool
     */
    protected $workflowClosed;

    /**
     * @var AbstractProcess
     */
    protected $workflowItem;

    /**
     * @var bool
     */
    protected $menuFound = false;


    public function __construct(AbstractContainer $parentContainer = null)
    {

        parent::__construct($parentContainer);
        $this->table = new AdminTable($this);

    }


    protected function loadWorkflowItem()
    {

        $this->workflowExist = $this->process->existItem();
        $this->workflowClosed = $this->process->isWorkflowClosed();
        $this->nextStatus = $this->workflowStatus->getNextMenu();

    }


    protected function addSubmenu(AbstractProcessStatus $status)
    {

        if ($this->workflowExist && !$this->workflowClosed) {

            if ($this->nextStatus->typeId == $status->typeId) {

                $this->addSubmenuWithoutCheck($this->workflowStatus);

            }
        }

    }


    protected function addSubmenuWithoutCheck(AbstractProcessStatus $status)
    {

        if ($this->workflowExist && !$this->workflowClosed) {

            foreach ($status->getMenuList() as $menuStatus) {

                $row = new TableRow($this->table);
                if ($this->formStatus->typeId == $menuStatus->typeId) {
                    new ArrowRightIcon($row);

                    $bold = new Bold($row);
                    $bold->content = $menuStatus->typeLabel;
                    $bold->addCssClass('ml-3');


                } else {
                    $row->addEmpty();

                    $site = clone($this->site);
                    $site->addParameter(new StatusParameter($menuStatus->typeId));
                    $site->title = $menuStatus->typeLabel;

                    $hyperlink = new SiteHyperlink($row);
                    $hyperlink->site = $site;
                    $hyperlink->addCssClass('ml-3');

                }


                $row->addEmpty();

            }

        }

    }


    protected function addNextStatusMenu(AbstractProcessStatus $status = null)
    {

        if ($status !== null) {
            $this->addLabel($status);
            $this->addNextStatusMenu($status->getNextMenu());
        }

    }

    protected function addActiveMenu(AbstractProcessStatus $status = null)
    {

        if (!$this->menuFound && !$this->workflowClosed) {

            if ($this->nextStatus !== null) {

                if ($this->nextStatus->typeId == $status->typeId) {

                    if ($this->formStatus->typeId == $status->typeId) {

                        $row = new TableRow($this->table);

                        new ArrowRightIcon($row);

                        $bold = new Bold($row);
                        $bold->content = $status->typeLabel;

                    } else {

                        $row = new TableRow($this->table);
                        $row->addEmpty();

                        $site = clone($this->site);
                        $site->addParameter(new StatusParameter($status->typeId));
                        $site->title = $status->typeLabel;

                        $hyperlink = new SiteHyperlink($row);
                        $hyperlink->site = $site;

                    }

                    $this->menuFound = true;

                }
            }
        }
    }


    protected function addCheckLabel(AbstractProcessStatus $status)
    {

        if ($status->showMenu) {

            if (!$this->menuFound) {
                $row = new TableRow($this->table);
                new CheckIcon($row);
                $row->addText($status->typeLabel);
                $row->addEmpty();

                $this->menuFound = true;

            }
        }

    }


    protected function addCheckSite(AbstractProcessStatus $status)
    {

        if ($status->showMenu) {

            if (!$this->menuFound) {

                $row = new TableRow($this->table);
                new CheckIcon($row);

                $site = clone($this->site);
                $site->addParameter(new StatusParameter($status->typeId));
                $site->title = $status->typeLabel;

                $hyperlink = new SiteHyperlink($row);
                $hyperlink->site = $site;

                $row->addEmpty();

                $this->menuFound = true;

            }
        }

    }


    protected function addArrowLabel(AbstractProcessStatus $status)
    {

        if ($status->showMenu) {

            if (!$this->menuFound) {

                $row = new TableRow($this->table);
                new ArrowRightIcon($row);
                $row->addBoldText($status->typeLabel);
                $row->addEmpty();

                $this->menuFound = true;

            }

        }
    }


    protected function addLabel(AbstractProcessStatus $status)
    {

        if ($status->showMenu) {

            if (!$this->menuFound) {

                $row = new TableRow($this->table);
                $row->addEmpty();
                $row->addText($status->typeLabel);
                $row->addEmpty();
                $this->menuFound = true;
            }

        }

    }


}