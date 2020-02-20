<?php


namespace Nemundo\Process\Workflow\Com\Menu;


class ProcessMenu extends AbstractProcessMenu
{

    public function getContent()
    {

        $this->loadWorkflowItem();

        /*if ($this->workflowExist) {
            $this->addSubmenuWithoutCheck($this->workflowStatus);
        }*/


        foreach ($this->process->getProcessStatusList() as $status) {

            $this->menuFound = false;

            if (!$this->workflowExist) {

                if ($this->process->startContentType->typeId == $status->typeId) {
                    $this->addArrowLabel($status);
                } else {
                    $this->addLabel($status);
                }

            } else {


                $this->addActiveMenu($status);

                if ($this->workflowStatusFound) {
                    $this->addLabel($status);
                } else {

                    if ($status->editable && !$this->workflowClosed) {
                        $this->addCheckSite($status);
                    } else {

                        if ($this->process->getFirstOf($status)!==null) {
                            $this->addCheckLabel($status);
                        } else {
                            $this->addLabel($status);
                        }


                    }

                }

                $this->addSubmenu($status);

                if ($status->typeId == $this->workflowStatus->typeId) {
                    $this->workflowStatusFound = true;
                }

            }

        }

        return parent::getContent();
    }

}