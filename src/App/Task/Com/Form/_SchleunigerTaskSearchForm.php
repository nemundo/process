<?php

namespace Nemundo\Process\App\Task\Com\Form;


use Nemundo\Admin\Com\Button\AdminSearchIcon;
use Nemundo\App\Content\Data\ContentType\ContentTypeListBox;
use Nemundo\Com\FormBuilder\SearchForm;
use Nemundo\Package\Bootstrap\Form\BootstrapFormRow;
use Nemundo\Process\App\Task\Com\ListBox\TaskTypeListBox;
use Nemundo\Process\App\Task\Parameter\TaskTypeParameter;
use Nemundo\Process\Group\Com\ListBox\MultiGroupListBox;
use Nemundo\User\Data\User\UserListBox;
use Nemundo\Workflow\App\Assignment\Parameter\SourceParameter;
use Nemundo\Workflow\App\Workflow\Com\ListBox\OpenClosedWorkflowListBox;
use Nemundo\Workflow\App\Workflow\Parameter\WorkflowStatusParameter;
use Schleuniger\App\Aufgabe\Site\ClearSearchSite;
use Schleuniger\App\GlobalGroup\Group\GlobalGroupContentType;
use Schleuniger\App\Org\Com\MitarbeiterListBox;
use Schleuniger\App\Org\Content\Mitarbeiter\MitarbeiterContentType;
use Schleuniger\App\Org\Parameter\ErstellerParameter;
use Schleuniger\App\Org\Parameter\VerantwortlicherParameter;

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
        $this->addInputName((new VerantwortlicherParameter())->getParameterName());
        $this->addInputName((new ErstellerParameter())->getParameterName());
        $this->addInputName((new SourceParameter())->getParameterName());
        $this->addInputName((new TaskTypeParameter())->getParameterName());
$this->addInputName((new WorkflowStatusParameter())->getParameterName());

        $this->formRow = new BootstrapFormRow($this);

        $this->verantwortlicher = new MultiGroupListBox($this->formRow);  // new MitarbeiterListBox($this->formRow);
        $this->verantwortlicher->label = 'Verantwortlicher';
        $this->verantwortlicher->name = (new VerantwortlicherParameter())->getParameterName();
        //$this->verantwortlicher->value = $this->verantwortlicher->getValue();
        $this->verantwortlicher->searchMode = true;
        $this->verantwortlicher->submitOnChange = true;
        $this->verantwortlicher->addGroupType(new MitarbeiterContentType());
        $this->verantwortlicher->addGroupType(new GlobalGroupContentType());


        $this->status = new OpenClosedWorkflowListBox($this->formRow);
        $this->status->submitOnChange = true;

        $this->ersteller = new MitarbeiterListBox($this->formRow);
        $this->ersteller->label = 'Ersteller';
        $this->ersteller->name = (new ErstellerParameter())->getParameterName();
        $this->ersteller->value = $this->ersteller->getValue();
        $this->ersteller->submitOnChange = true;

        $this->source = new TaskTypeListBox($this->formRow);  // new AssignmentSourceListBox($this->formRow);
        $this->source->searchMode = true;
        $this->source->submitOnChange = true;


        $btn = new AdminSearchIcon($this->formRow);
        $btn->site = ClearSearchSite::$site;

    }


    public function getContent()
    {


        return parent::getContent();

    }

}