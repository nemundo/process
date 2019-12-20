<?php


namespace Nemundo\Process\Workflow\Content\Item\Status;


use Nemundo\Core\Type\DateTime\DateTime;


class DateTimeUserIdStatusItem extends AbstractStatusItem
{

    /**
     * @var DateTime
     */
    public $dateTime;


    public $mitarbeiterId;


    public function saveItem()
    {

        $this->saveWorkflowLog();

    }

}