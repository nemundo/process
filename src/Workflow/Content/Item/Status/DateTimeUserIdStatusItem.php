<?php


namespace Nemundo\Process\Workflow\Content\Item\Status;


use Nemundo\Core\Type\DateTime\DateTime;


class DateTimeUserIdStatusItem extends AbstractStatusItem  // StatusLogBuilder
{

    /**
     * @var DateTime
     */
    public $dateTime;


   public $userId;


   public function saveItem()
   {

       $this->saveWorkflowLog();

       // TODO: Implement saveItem() method.
   }

}