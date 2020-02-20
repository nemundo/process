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
use Nemundo\Process\Content\Data\Tree\TreeReader;
use Nemundo\Process\Content\Type\AbstractSequenceContentType;
use Nemundo\Process\Workflow\Content\Process\AbstractProcess;
use Nemundo\Process\Workflow\Content\Status\AbstractProcessStatus;
use Nemundo\Process\Workflow\Parameter\StatusParameter;
use Nemundo\Web\Site\Site;

class WorkflowLogMenu extends LogMenu  // AdminTable
{

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
    public $currentStatus;

    //private $subMenuCssClass = 'ml-3';


    public function getContent()
    {


        $startMenu = $this->process->startContentType;


        if ($this->process->getDataId() !== null) {


            $reader = new TreeReader();
            $reader->model->loadChild();
            $reader->model->child->loadContentType();
            $reader->model->child->loadUser();
            $reader->filter->andEqual($reader->model->parentId, $this->process->getContentId());
            $reader->addOrder($reader->model->itemOrder);
            foreach ($reader->getData() as $treeRow) {

                /** @var AbstractProcessStatus $contentType */
                $contentType = $treeRow->child->getContentType();

                if ($contentType->isObjectOfClass(AbstractProcessStatus::class)) {

                    if ($contentType->changeStatus) {

                        $row = new TableRow($this);
                        new CheckIcon($row);

                        if ($contentType->editable && !$this->process->isWorkflowClosed()) {

                            $site = new Site();
                            $site->addParameter(new StatusParameter($contentType->typeId));
                            $site->title = $contentType->typeLabel;

                            $td = new Td($row);
                            $td->nowrap=true;

                            $hyperlink = new SiteHyperlink($td);
                            $hyperlink->site = $site;


                        } else {

                        $row->addText($contentType->typeLabel,true);
                        }

                        $td = new Td($row);
                        $td->nowrap=true;

                        $span = new Span($td);
                        $span->title = $treeRow->child->user->displayName;
                        $span->content=$treeRow->child->user->login . ' ' . $treeRow->child->dateTime->getShortDateLeadingZeroFormat();

                        //$row->addText($treeRow->child->user->login . ' ' . $treeRow->child->dateTime->getShortDateLeadingZeroFormat());

                    }

                }

            }

            if ($this->currentStatus !== null) {

                /** @var AbstractProcessStatus $nextStatus */
                $nextStatus = $this->currentStatus->getNextMenu();

                $startMenu = $nextStatus;

                if ($nextStatus !== null) {

                    $row = new TableRow($this);

                    if ($this->formStatus->typeId == $nextStatus->typeId) {
                        new ArrowRightIcon($row);
                        $bold = new Bold($row);
                        $bold->content = $nextStatus->typeLabel;

                    } else {

                        $row->addEmpty();

                        $site = new Site();
                        $site->addParameter(new StatusParameter($nextStatus->typeId));
                        $site->title = $nextStatus->typeLabel;

                        $td = new Td($row);
                        $td->nowrap=true;

                        $hyperlink = new SiteHyperlink($td);
                        $hyperlink->site = $site;

                    }

                    $row->addEmpty();

                }

                foreach ($this->currentStatus->getMenuList() as $menuStatus) {

                    $row = new TableRow($this);

                    if ((new StatusParameter())->getValue() == $menuStatus->typeId) {

                        new ArrowRightIcon($row);

                        $bold = new Bold($row);
                        $bold->content = $menuStatus->typeLabel;
                        $bold->addCssClass($this->subMenuCssClass);

                    } else {

                        $row->addEmpty();

                        $site = new Site();
                        $site->addParameter(new StatusParameter($menuStatus->typeId));
                        $site->title = $menuStatus->typeLabel;

                        $td = new Td($row);
                        $td->nowrap=true;

                        $hyperlink = new SiteHyperlink($td);
                        $hyperlink->site = $site;
                        $hyperlink->addCssClass($this->subMenuCssClass);

                    }

                    $row->addEmpty();

                }

            }

        } else {


            $row = new TableRow($this);

            new ArrowRightIcon($row);

            $bold = new Bold($row);
            $bold->content = $startMenu->typeLabel;

            $row->addEmpty();

        }

        if ($startMenu !== null) {
            $this->addMenu($startMenu->getNextMenu());
        }

        return parent::getContent();

    }


    private function addMenu(AbstractSequenceContentType $status = null)
    {

        if ($status !== null) {

            $row = new TableRow($this);
            $row->addEmpty();
            $row->addText($status->typeLabel,true);
            $row->addEmpty();

            $this->addMenu($status->getNextMenu());

        }

    }

}