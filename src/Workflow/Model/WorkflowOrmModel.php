<?php


namespace Nemundo\Process\Workflow\Model;


use Nemundo\App\ModelDesigner\Type\ExternalModelDesignerType;
use Nemundo\App\ModelDesigner\Type\TextModelDesignerType;
use Nemundo\Orm\Model\AbstractOrmModel;
use Nemundo\Orm\Type\DateTime\DateOrmType;
use Nemundo\Orm\Type\DateTime\DateTimeOrmType;
use Nemundo\Orm\Type\Number\NumberOrmType;
use Nemundo\Orm\Type\Number\YesNoOrmType;
use Nemundo\Orm\Type\Text\TextOrmType;
use Nemundo\Process\Content\Row\ContentCustomRow;
use Nemundo\Process\Content\Row\ContentTypeCustomRow;

class WorkflowOrmModel extends AbstractOrmModel
{

    /**
     * @var YesNoOrmType
     */
    public $active;

    /**
     * @var NumberOrmType
     */
    public $number;

    /**
     * @var TextOrmType
     */
    public $workflowNumber;

    /**
     * @var TextOrmType
     */
    public $subject;

    /**
     * @var YesNoOrmType
     */
    public $workflowClosed;

    /**
     * @var ExternalModelDesignerType
     */
    public $status;

    /**
     * @var DateOrmType
     */
    public $deadline;

    /**
     * @var ExternalModelDesignerType
     */
    public $assignment;

    /**
     * @var DateTimeOrmType
     */
    public $dateTime;

    /**
     * @var ExternalModelDesignerType
     */
    public $user;

    /**
     * @var ExternalModelDesignerType
     */
    public $content;


    public function __construct()
    {

        parent::__construct();

        $this->templateLabel = 'Workflow Model';
        $this->templateName = 'workflow_model';
        $this->templateId = '76f2cc9e-23a0-4375-a1c6-6c562c474b6b';
        $this->templateExtendsClass = AbstractWorkflowModel::class;

        $this->active = new YesNoOrmType($this);
        $this->active->label = 'Active';
        $this->active->fieldName = 'active';
        $this->active->variableName = 'active';
        $this->active->createModelProperty = false;
        $this->active->isEditable = false;

        $this->number = new NumberOrmType($this);
        $this->number->label = 'Number';
        $this->number->fieldName = 'number';
        $this->number->variableName = 'number';
        $this->number->createModelProperty = false;
        $this->number->isEditable = false;

        $this->workflowNumber = new TextModelDesignerType($this);
        $this->workflowNumber->label = 'Workflow Number';
        $this->workflowNumber->fieldName = 'workflow_number';
        $this->workflowNumber->variableName = 'workflowNumber';
        $this->workflowNumber->createModelProperty = false;
        $this->workflowNumber->isEditable = false;
        $this->workflowNumber->length = 20;

        $this->subject = new TextModelDesignerType($this);
        $this->subject->label = 'Subject';
        $this->subject->fieldName = 'subject';
        $this->subject->variableName = 'subject';
        $this->subject->createModelProperty = false;
        $this->subject->isEditable = false;
        $this->subject->length = 255;

        $this->workflowClosed = new YesNoOrmType($this);
        $this->workflowClosed->label = 'Workflow Closed';
        $this->workflowClosed->fieldName = 'workflow_closed';
        $this->workflowClosed->variableName = 'workflowClosed';
        $this->workflowClosed->createModelProperty = false;
        $this->workflowClosed->isEditable = false;

        $this->status = new ExternalModelDesignerType($this);
        $this->status->label = 'Status';
        $this->status->fieldName = 'status';
        $this->status->variableName = 'status';
        $this->status->createModelProperty = false;
        $this->status->isEditable = false;
        //$this->status->externalClassName = 'Nemundo\Process\Content\Data\ContentType\ContentType';
        $this->status->externalClassName = 'Nemundo\Process\Content\Data\Content\Content';
        //$this->status->rowClassName = ContentTypeCustomRow::class;
        $this->status->rowClassName = ContentCustomRow::class;

        $this->deadline = new DateOrmType($this);
        $this->deadline->label = 'Deadline';
        $this->deadline->fieldName = 'deadline';
        $this->deadline->variableName = 'deadline';
        $this->deadline->createModelProperty = false;
        $this->deadline->isEditable = false;

        $this->assignment = new ExternalModelDesignerType($this);
        $this->assignment->label = 'Assignment';
        $this->assignment->fieldName = 'assignment';
        $this->assignment->variableName = 'assignment';
        $this->assignment->createModelProperty = false;
        $this->assignment->isEditable = false;
        $this->assignment->externalClassName = 'Nemundo\Process\Group\Data\Group\Group';

        $this->dateTime = new DateTimeOrmType($this);
        $this->dateTime->label = 'Date/Time';
        $this->dateTime->fieldName = 'date_time';
        $this->dateTime->variableName = 'dateTime';
        $this->dateTime->createModelProperty = false;
        $this->dateTime->isEditable = false;

        $this->user = new ExternalModelDesignerType($this);
        $this->user->label = 'User';
        $this->user->fieldName = 'user';
        $this->user->variableName = 'user';
        $this->user->createModelProperty = false;
        $this->user->isEditable = false;
        $this->user->externalClassName = 'Nemundo\User\Data\User\User';

        $this->content = new ExternalModelDesignerType($this);
        $this->content->label = 'Content';
        $this->content->fieldName = 'content';
        $this->content->variableName = 'content';
        $this->content->createModelProperty = false;
        $this->content->isEditable = false;
        $this->content->externalClassName = 'Nemundo\Process\Content\Data\ContentType\ContentType';
        $this->content->rowClassName = ContentCustomRow::class;

    }


    protected function loadModel()
    {

    }

}