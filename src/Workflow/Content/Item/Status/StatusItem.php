<?php


namespace Nemundo\Process\Workflow\Content\Item\Status;


class StatusItem extends AbstractStatusItem
{

    public function saveItem()
    {
        $this->saveWorkflowLog();
    }

}