<?php


namespace Nemundo\Process\Workflow\Com\Menu;


use Nemundo\Com\Html\Hyperlink\SiteHyperlink;
use Nemundo\Com\TableBuilder\TableRow;
use Nemundo\Html\Formatting\Bold;
use Nemundo\Html\Inline\Span;
use Nemundo\Html\Table\Td;
use Nemundo\Package\FontAwesome\Icon\ArrowRightIcon;
use Nemundo\Package\FontAwesome\Icon\CheckIcon;
use Nemundo\Process\Content\Data\Tree\TreeReader;
use Nemundo\Process\Content\Parameter\DataIdParameter;
use Nemundo\Process\Content\Type\AbstractSequenceContentType;
use Nemundo\Process\Workflow\Content\Process\AbstractProcess;
use Nemundo\Process\Workflow\Content\Status\AbstractProcessStatus;
use Nemundo\Process\Workflow\Parameter\StatusParameter;

class WorkflowLogMenu extends LogMenu
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

                    if ($contentType->isStatusChangeable()) {

                        $row = new TableRow($this);

                        if ($contentType->isDraft()) {
                            new ArrowRightIcon($row);

                            $bold = new Bold($row);
                            $bold->content = $contentType->typeLabel;

                        } else {
                            new CheckIcon($row);

                            if ($contentType->editable && !$this->process->isWorkflowClosed()) {

                                $site = clone($this->redirectSite);
                                $site->addParameter(new StatusParameter($contentType->typeId));

                                if ($contentType->appendDataIdParameter) {
                                    $site->addParameter(new DataIdParameter($contentType->getDataId()));
                                }

                                $site->title = $contentType->typeLabel;

                                $td = new Td($row);
                                $td->nowrap = true;

                                $hyperlink = new SiteHyperlink($td);
                                $hyperlink->site = $site;


                            } else {

                                $row->addText($contentType->typeLabel, true);
                            }

                        }

                        $td = new Td($row);
                        $td->nowrap = true;

                        $span = new Span($td);
                        $span->title = $treeRow->child->user->displayName;
                        $span->content = $treeRow->child->user->login . ' ' . $treeRow->child->dateTime->getShortDateLeadingZeroFormat();

                    }

                }

            }

            if ($this->currentStatus !== null) {

                if ($this->currentStatus->isDraft()) {
                    $this->addNextMenu();
                }

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

                        if ($this->currentStatus->isDraft()) {

                            //$this->addMenu($nextStatus);


                            $row->addText($nextStatus->typeLabel, true);
                            //$row->addEmpty();


                        } else {

                            //$row->addEmpty();

                            $site = clone($this->redirectSite);
                            $site->addParameter(new StatusParameter($nextStatus->typeId));
                            $site->title = $nextStatus->typeLabel;

                            $td = new Td($row);
                            $td->nowrap = true;

                            $hyperlink = new SiteHyperlink($td);
                            $hyperlink->site = $site;

                        }

                    }

                    $row->addEmpty();

                }

                if (!$this->currentStatus->isDraft()) {
                    $this->addNextMenu();
                }

                //(new Debug())->write($this->currentStatus->getClassName());

                /*if (!$this->process->isWorkflowClosed()) {

                    foreach ($this->currentStatus->getMenuList() as $menuStatus) {

                        $row = new TableRow($this);

                        if ((new StatusParameter())->getValue() == $menuStatus->typeId) {

                            new ArrowRightIcon($row);

                            $bold = new Bold($row);
                            $bold->content = $menuStatus->typeLabel;
                            $bold->addCssClass($this->subMenuCssClass);

                        } else {

                            $row->addEmpty();

                            $site = clone($this->redirectSite);
                            $site->addParameter(new StatusParameter($menuStatus->typeId));
                            $site->title = $menuStatus->typeLabel;

                            $td = new Td($row);
                            $td->nowrap = true;

                            $hyperlink = new SiteHyperlink($td);
                            $hyperlink->site = $site;
                            $hyperlink->addCssClass($this->subMenuCssClass);

                        }

                        $row->addEmpty();

                    }
                }*/



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



    private function addNextMenu() {


        if (!$this->process->isWorkflowClosed()) {

            foreach ($this->currentStatus->getMenuList() as $menuStatus) {

                $row = new TableRow($this);

                if ((new StatusParameter())->getValue() == $menuStatus->typeId) {

                    new ArrowRightIcon($row);

                    $bold = new Bold($row);
                    $bold->content = $menuStatus->typeLabel;
                    $bold->addCssClass($this->subMenuCssClass);

                } else {

                    $row->addEmpty();

                    $site = clone($this->redirectSite);
                    $site->addParameter(new StatusParameter($menuStatus->typeId));
                    $site->title = $menuStatus->typeLabel;

                    $td = new Td($row);
                    $td->nowrap = true;

                    $hyperlink = new SiteHyperlink($td);
                    $hyperlink->site = $site;
                    $hyperlink->addCssClass($this->subMenuCssClass);

                }

                $row->addEmpty();

            }
        }



    }


    private function addMenu(AbstractSequenceContentType $status = null)
    {

        if ($status !== null) {

            $row = new TableRow($this);
            $row->addEmpty();
            $row->addText($status->typeLabel, true);
            $row->addEmpty();

            $this->addMenu($status->getNextMenu());

        }

    }

}