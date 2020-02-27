<?php

namespace Nemundo\Process\App\Task\Com;


use Nemundo\Admin\Com\Button\AdminSearchIcon;
use Nemundo\App\Content\Data\ContentType\ContentTypeListBox;
use Nemundo\Com\FormBuilder\SearchForm;
use Nemundo\Core\Directory\KeyValue;
use Nemundo\Db\Sql\Field\CountField;
use Nemundo\Package\Bootstrap\Form\BootstrapFormRow;
use Nemundo\Package\Bootstrap\FormElement\BootstrapListBox;
use Nemundo\Process\App\Assignment\Com\ListBox\AssignmentSourceListBox;
use Nemundo\Process\App\Task\Com\ListBox\TaskTypeListBox;
use Nemundo\Process\Group\Com\ListBox\MultiGroupListBox;
use Nemundo\Process\Workflow\Com\ListBox\ProcessListBox;
use Nemundo\User\Data\User\UserListBox;
use Nemundo\Workflow\App\Assignment\Data\Assignment\AssignmentReader;
use Nemundo\Workflow\App\Assignment\Data\AssignmentFilter\AssignmentFilterReader;
use Nemundo\Workflow\App\Assignment\Parameter\SourceParameter;
use Nemundo\Workflow\App\Workflow\Com\ListBox\OpenClosedWorkflowListBox;
use Schleuniger\App\Aufgabe\Site\AufgabeSite;
use Schleuniger\App\Aufgabe\Site\AufgabeTeamSite;
use Schleuniger\App\Aufgabe\Site\ClearSearchSite;
use Schleuniger\App\GlobalGroup\Group\GlobalGroupContentType;
use Schleuniger\App\Org\Com\MitarbeiterListBox;
use Schleuniger\App\Org\Content\Mitarbeiter\MitarbeiterContentType;
use Schleuniger\App\Org\Parameter\ErstellerParameter;
use Schleuniger\App\Org\Parameter\VerantwortlicherParameter;
use Schleuniger\App\Task\Search\TaskSearchParameter;
use Schleuniger\App\Task\Site\Search\ClearSearchFilterSite;
use Schleuniger\App\Task\Site\TaskSite;
use Schleuniger\App\TeamAssignment\Site\TeamAssignmentSite;

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

        $this->formRow = new BootstrapFormRow($this);

        $this->verantwortlicher = new MultiGroupListBox($this->formRow);  // new MitarbeiterListBox($this->formRow);
        $this->verantwortlicher->label = 'Verantwortlicher';
        $this->verantwortlicher->name = (new VerantwortlicherParameter())->getParameterName();
        //$this->verantwortlicher->value = $this->verantwortlicher->getValue();
        $this->verantwortlicher->searchMode=true;
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
        $this->source->searchMode= true;
        $this->source->submitOnChange = true;


        $btn = new AdminSearchIcon($this->formRow);
        $btn->site =ClearSearchSite::$site;

    }


    public function getContent()
    {


        return parent::getContent();

    }

}