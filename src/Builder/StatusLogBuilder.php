<?php


namespace Nemundo\Process\Builder;


use Nemundo\Core\Type\DateTime\DateTime;
use Nemundo\Process\Status\AbstractStatus;

class StatusLogBuilder extends AbstractStatusLogBuilder
{

    /**
     * @var AbstractStatus
     */
    public $contentType;

    /**
     * @var DateTime
     */
    //protected $dateTime;

    //protected $userId;



    public $dataId;


    public function saveItem()
    {
        // TODO: Implement saveStatus() method.

        $this->saveWorkflowLog();

    }

}