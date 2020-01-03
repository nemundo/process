<?php


namespace Nemundo\Process\Workflow\Com\Menu;


use Nemundo\Admin\Com\Table\AdminTable;
use Nemundo\Com\Html\Hyperlink\SiteHyperlink;
use Nemundo\Com\TableBuilder\TableRow;
use Nemundo\Html\Block\Div;
use Nemundo\Html\Container\AbstractContainer;
use Nemundo\Html\Container\AbstractHtmlContainer;
use Nemundo\Html\Formatting\Bold;
use Nemundo\Package\FontAwesome\Icon\ArrowRightIcon;
use Nemundo\Package\FontAwesome\Icon\CheckIcon;
use Nemundo\Process\Workflow\Content\Item\Process\WorkflowItem;
use Nemundo\Process\Workflow\Content\Process\AbstractProcess;
use Nemundo\Process\Workflow\Content\Process\WorkflowProcess;
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
     * @var WorkflowProcess
     */
    protected $workflowItem;

    /**
     * @var bool
     */
    protected $menuFound = false;


    public function __construct(AbstractContainer $parentContainer = null)
    {
        parent::__construct($parentContainer);

       /* $div = new Div($this);
        $div->content = $this->getClassNameWithoutNamespace();
*/

        $this->table = new AdminTable($this);

    }


    protected function loadWorkflowItem()
    {

        $this->workflowItem =new WorkflowProcess($this->workflowId);
        $this->workflowExist = $this->workflowItem->existWorkflow();
        $this->workflowClosed = $this->workflowItem->isWorkflowClosed();
        $this->nextStatus = $this->workflowStatus->getNextMenu();

    }



    protected function addSubmenu(AbstractProcessStatus $status)
    {

        if ($this->workflowExist && !$this->workflowClosed) {

            if ($this->nextStatus->contentId == $status->contentId) {

                $this->addSubmenuWithoutCheck($this->workflowStatus);

            }
        }

    }


    protected function addSubmenuWithoutCheck(AbstractProcessStatus $status)
    {

        if ($this->workflowExist && !$this->workflowClosed) {

            foreach ($status->getMenuList() as $menuStatus) {

                $row = new TableRow($this->table);
                if ($this->formStatus->contentId == $menuStatus->contentId) {
                    new ArrowRightIcon($row);

                    $bold = new Bold($row);
                    $bold->content = $menuStatus->contentLabel;
                    $bold->addCssClass('ml-3');


                } else {
                    $row->addEmpty();

                    $site = clone($this->site);
                    $site->addParameter(new StatusParameter($menuStatus->contentId));
                    $site->title = $menuStatus->contentLabel;

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
            //$this->addStatusLabel($status);
            $this->addLabel($status);
            $this->addNextStatusMenu($status->getNextMenu());
        }

    }

    protected function addActiveMenu(AbstractProcessStatus $status=null)
    {


        if (!$this->menuFound && !$this->workflowClosed) {

            if ($this->nextStatus !== null) {

                if ($this->nextStatus->contentId == $status->contentId) {

                    if ($this->formStatus->contentId == $status->contentId) {

                        $row = new TableRow($this->table);

                        new ArrowRightIcon($row);

                        $bold = new Bold($row);
                        $bold->content = $status->contentLabel;

                    } else {

                        $row = new TableRow($this->table);
                        $row->addEmpty();

                        $site = clone($this->site);
                        $site->addParameter(new StatusParameter($status->contentId));
                        $site->title = $status->contentLabel;

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
                $row->addText($status->contentLabel);
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
                $site->addParameter(new StatusParameter($status->contentId));
                $site->title = $status->contentLabel;

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
                $row->addText($status->contentLabel);
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
                $row->addText($status->contentLabel);
                $row->addEmpty();
                $this->menuFound = true;
            }

        }

    }


}