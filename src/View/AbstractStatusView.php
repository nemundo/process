<?php


namespace Nemundo\Process\View;


use Nemundo\Html\Container\AbstractHtmlContainer;
use Nemundo\Process\Status\AbstractStatus;

abstract class AbstractStatusView extends AbstractHtmlContainer
{

    /**
     * @var string
     */
    public $workflowId;

    /**
     * @var AbstractStatus
     */
    protected $status;

    /**
     * @var string
     */
    public $dataId;

}