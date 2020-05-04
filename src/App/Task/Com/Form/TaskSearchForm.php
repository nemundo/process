<?php

namespace Nemundo\Process\App\Task\Com\Form;


use Nemundo\App\Content\Data\ContentType\ContentTypeListBox;
use Nemundo\Com\FormBuilder\SearchForm;
use Nemundo\Package\Bootstrap\Form\BootstrapFormRow;
use Nemundo\Process\App\Task\Com\ListBox\TaskTypeListBox;
use Nemundo\Process\App\Task\Parameter\TaskTypeParameter;
use Nemundo\Process\Group\Com\ListBox\MultiGroupListBox;
use Nemundo\User\Com\ListBox\UserListBox;
use Nemundo\User\Parameter\UserParameter;
use Nemundo\Workflow\App\Assignment\Parameter\SourceParameter;
use Nemundo\Workflow\App\Workflow\Com\ListBox\OpenClosedWorkflowListBox;
use Nemundo\Workflow\App\Workflow\Parameter\WorkflowStatusParameter;


class TaskSearchForm extends SearchForm
{


    /**
     * @var MultiGroupListBox
     */
    private $verantwortlicher;

    /**
     * @var OpenClosedWorkflowListBox
     */
    private $status;

    /**
     * @var UserListBox
     */
    private $ersteller;

    /**
     * @var ContentTypeListBox
     */
    private $source;

    /**
     * @var BootstrapFormRow
     */
    private $formRow;

    protected function loadContainer()
    {
        parent::loadContainer();

        $this->addUrlAsHiddenInput = true;
        $this->addInputName((new SourceParameter())->getParameterName());
        $this->addInputName((new TaskTypeParameter())->getParameterName());
        $this->addInputName((new WorkflowStatusParameter())->getParameterName());

        $this->formRow = new BootstrapFormRow($this);

        $this->status = new OpenClosedWorkflowListBox($this->formRow);
        $this->status->submitOnChange = true;

        $this->ersteller = new UserListBox($this->formRow);
        $this->ersteller->label = 'Ersteller';
        $this->ersteller->name = (new UserParameter())->getParameterName();
        $this->ersteller->value = $this->ersteller->getValue();
        $this->ersteller->submitOnChange = true;

        $this->source = new TaskTypeListBox($this->formRow);
        $this->source->searchMode = true;
        $this->source->submitOnChange = true;

    }

}