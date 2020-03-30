<?php


namespace Nemundo\Process\Workflow\Com\Menu;


use Nemundo\Admin\Com\Table\AdminTable;
use Nemundo\Com\Html\Hyperlink\SiteHyperlink;
use Nemundo\Com\TableBuilder\TableRow;
use Nemundo\Html\Formatting\Bold;
use Nemundo\Html\Inline\Span;
use Nemundo\Html\Table\Td;
use Nemundo\Package\FontAwesome\Icon\ArrowRightIcon;
use Nemundo\Package\FontAwesome\Icon\CheckIcon;
use Nemundo\Web\Site\AbstractSite;

class LogMenu extends AdminTable
{

    /**
     * @var AbstractSite
     */
    public $redirectSite;

    protected $subMenuCssClass = 'ml-3';


    public function addSite(AbstractSite $site)
    {

        $row = new TableRow($this);
        $row->addEmpty();

        $td = new Td($row);
        $td->nowrap = true;

        $hyperlink = new SiteHyperlink($td);
        $hyperlink->site = $site;

    }


    public function addCheckSite(AbstractSite $site)
    {

        $row = new TableRow($this);
        new CheckIcon($row);

        $td = new Td($row);
        $td->nowrap = true;

        $hyperlink = new SiteHyperlink($td);
        $hyperlink->site = $site;

    }


    public function addArrowSite(AbstractSite $site)
    {

        $row = new TableRow($this);
        new ArrowRightIcon($row);

        $td = new Td($row);
        $td->nowrap = true;

        $hyperlink = new SiteHyperlink($td);
        $hyperlink->site = $site;

    }


    public function addSubSite(AbstractSite $site)
    {

        $row = new TableRow($this);
        $row->addEmpty();

        $td = new Td($row);
        $td->nowrap = true;

        $hyperlink = new SiteHyperlink($td);
        $hyperlink->site = clone($site);
        $hyperlink->addCssClass($this->subMenuCssClass);

    }


    public function addSubLabel($label)
    {

        $row = new TableRow($this);
        $row->addEmpty();

        $td = new Td($row);
        $td->nowrap = true;

        $span = new Span($td);
        $span->content = $label;
        $span->addCssClass($this->subMenuCssClass);

    }


    public function addLabel($label)
    {

        $row = new TableRow($this);
        new CheckIcon($row);

        $td = new Td($row);
        $td->nowrap = true;
        $td->content = $label;

    }


    public function addArrowLabel($label)
    {

        $row = new TableRow($this);
        new ArrowRightIcon($row);

        $td = new Td($row);
        $td->nowrap = true;

        $bold = new Bold($td);
        $bold->content = $label;


    }


}