<?php


namespace Nemundo\Process\Workflow\Com\Menu;


use Nemundo\Com\TableBuilder\TableRow;
use Nemundo\Package\FontAwesome\Icon\CheckIcon;
use Nemundo\Process\Workflow\Content\Status\AbstractProcessStatus;

class HistoryProcessMenu extends AbstractProcessMenu
{


    public function getContent()
    {

        $this->loadWorkflowItem();

        foreach ($this->workflowItem->getChild() as $contentRow) {

            $row = new TableRow($this->table);
            new CheckIcon($row);

            /** @var AbstractProcessStatus $contentType */
            $contentType = $contentRow->contentType->getContentType();

            $row->addText($contentType->contentLabel);

            $text = $contentRow->userCreated->displayName . ' ' . $contentRow->dateTimeCreated->getShortDateFormat();
            $row->addText($text);

        }


        if (!$this->workflowExist) {
            $this->addArrowLabel($this->process->startStatus);
            $this->workflowStatusFound = true;

            $this->addNextStatusMenu($this->process->startStatus->getNextMenu());
        } else {

            $this->addActiveMenu($this->nextStatus);
            $this->addSubmenuWithoutCheck($this->workflowStatus);

            $this->workflowStatusFound = true;

            if ($this->nextStatus !== null) {
                $this->addNextStatusMenu($this->nextStatus->getNextMenu());
            }

        }

        return parent::getContent();

    }

}