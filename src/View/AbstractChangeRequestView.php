<?php


namespace Nemundo\Process\View;


use Nemundo\Admin\Com\Widget\AbstractAdminWidget;
use Nemundo\Html\Container\AbstractHtmlContainer;
use Nemundo\Process\Status\AbstractStatus;

abstract class AbstractChangeRequestView extends AbstractAdminWidget  // AbstractHtmlContainer
{

    /**
     * @var string
     */
    public $workflowId;

    /**
     * @var AbstractStatus
     */
    protected $status;

    abstract protected function loadView();


    protected function loadWidget()
    {
        // TODO: Implement loadWidget() method.

        $this->loadView();

        $this->widgetTitle = $this->status->label;


    }

}