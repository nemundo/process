<?php


namespace Nemundo\Process\Builder;


use Nemundo\Core\Type\DateTime\DateTime;
use Nemundo\Process\Status\AbstractStatus;

class StatusLogBuilder extends AbstractStatusLogBuilder
{

    /**
     * @var AbstractStatus
     */
    public $status;

    /**
     * @var DateTime
     */
    public $dateTime;

    public $userId;



    public $dataId;


    public function saveStatus()
    {
        // TODO: Implement saveStatus() method.

        $this->saveWorkflowLog();

    }

}