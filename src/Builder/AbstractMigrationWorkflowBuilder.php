<?php


namespace Nemundo\Process\Builder;


use Nemundo\Core\Type\DateTime\DateTime;
use Nemundo\Process\Item\AbstractWorkflowItem;

abstract class AbstractMigrationWorkflowBuilder extends AbstractWorkflowItem
{

    /**
     * @var int
     */
   public $number;

    /**
     * @var string
     */
    public $workflowNumber;

    /**
     * @var DateTime
     */
    public $dateTime;

    /**
     * @var string
     */
    public $userId;

}