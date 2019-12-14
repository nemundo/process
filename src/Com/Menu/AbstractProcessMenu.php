<?php


namespace Nemundo\Process\Com\Menu;


use Nemundo\Admin\Com\Table\AdminTable;
use Nemundo\Com\Html\Hyperlink\SiteHyperlink;
use Nemundo\Com\TableBuilder\TableRow;
use Nemundo\Html\Block\Div;
use Nemundo\Html\Container\AbstractContainer;
use Nemundo\Html\Container\AbstractHtmlContainer;
use Nemundo\Package\FontAwesome\Icon\ArrowRightIcon;
use Nemundo\Process\Parameter\StatusParameter;
use Nemundo\Process\Process\AbstractProcess;
use Nemundo\Process\Status\AbstractStatus;
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
     * @var AbstractStatus
     */
    public $formStatus;

    /**
     * @var AbstractStatus
     */
    public $workflowStatus;

    /**
     * @var AdminTable
     */
    protected $table;


    public function __construct(AbstractContainer $parentContainer = null)
    {
        parent::__construct($parentContainer);

        $div = new Div($this);
        $div->content = $this->getClassNameWithoutNamespace();

        $this->table = new AdminTable($this);

    }




    protected function addSubmenu(AbstractStatus $status)
    {

        foreach ($status->getMenuStatus() as $menuStatus) {

            $row = new TableRow($this->table);
            if ($this->formStatus->id == $menuStatus->id) {
                new ArrowRightIcon($row);
            } else {
                $row->addEmpty();
            }


            $site = clone($this->site);
            $site->addParameter(new StatusParameter($menuStatus->id));
            $site->title = $menuStatus->label;

            $hyperlink = new SiteHyperlink($row);
            $hyperlink->site = $site;
            $hyperlink->addCssClass('ml-3');

            $row->addEmpty();

        }


    }



    protected function addStatusLabel(AbstractStatus $status,$bold=false)
    {


        $row = new TableRow($this->table);

        if ($this->formStatus->id == $status->id) {
            new ArrowRightIcon($row);
        } else {
            $row->addEmpty();
        }



if ($bold) {
    $row->addBoldText($status->label);
} else {
    $row->addText($status->label);
}


        $row->addEmpty();


    }



    protected function addStatusSite(AbstractStatus $status)
    {


        $row = new TableRow($this->table);
        //$row->addEmpty();

        if ($this->formStatus->id == $status->id) {
            new ArrowRightIcon($row);
        } else {
            $row->addEmpty();
        }


        $site = clone($this->site);
        $site->title = $status->label;
        $site->addParameter(new StatusParameter($status->id));

        $hyperlink = new SiteHyperlink($row);
        $hyperlink->site = $site;

        $row->addEmpty();


    }



    /*
    protected function addStatus(AbstractStatus $status = null)
    {

        if ($status !== null) {

            $row = new TableRow($this->table);
            $row->addEmpty();

            $site = clone($this->site);
            $site->title = $status->label;
            $site->addParameter(new StatusParameter($status->id));

            $hyperlink = new SiteHyperlink($row);
            $hyperlink->site = $site;


            $row->addEmpty();

            $this->addStatus($status->getNextStatus());

        }


    }*/


}