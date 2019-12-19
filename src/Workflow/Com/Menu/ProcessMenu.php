<?php


namespace Nemundo\Process\Workflow\Com\Menu;


class ProcessMenu extends AbstractProcessMenu
{

    public function getContent()
    {

        $this->loadWorkflowItem();

        foreach ($this->process->getProcessStatusList() as $status) {

            $this->menuFound = false;

            if (!$this->workflowExist) {

                if ($this->workflowStatus->id === $status->id) {
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
                        $this->addCheckLabel($status);
                    }

                }


                $this->addSubmenu($status);

                if ($status->id == $this->workflowStatus->id) {
                    $this->workflowStatusFound = true;
                }

            }

        }

        return parent::getContent();
    }

}