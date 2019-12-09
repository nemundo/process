<?php


namespace Nemundo\Process\Builder;


use Nemundo\Core\Type\DateTime\DateTime;

abstract class AbstractMigrationWorkflowBuilder extends AbstractWorkflowBuilder
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