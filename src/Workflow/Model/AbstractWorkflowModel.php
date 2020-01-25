<?php


namespace Nemundo\Process\Workflow\Model;


use Nemundo\Model\Definition\Model\AbstractModel;
use Nemundo\Model\Type\DateTime\DateTimeType;
use Nemundo\Model\Type\External\Id\ExternalUniqueIdType;
use Nemundo\Model\Type\Number\NumberType;
use Nemundo\Model\Type\Number\YesNoType;
use Nemundo\Model\Type\Text\TextType;
use Nemundo\Process\Content\Data\ContentType\ContentTypeExternalType;
use Nemundo\User\Data\User\UserExternalType;

abstract class AbstractWorkflowModel extends AbstractModel
{

    /**
     * @var YesNoType
     */
    public $active;

    /**
     * @var NumberType
     */
    public $number;

    /**
     * @var TextType
     */
    public $workflowNumber;


    /**
     * @var \Nemundo\Model\Type\Text\TextType
     */
    public $subject;

    /**
     * @var \Nemundo\Model\Type\Number\YesNoType
     */
    public $workflowClosed;

    /**
     * @var \Nemundo\Model\Type\External\Id\ExternalUniqueIdType
     */
    public $statusId;

    /**
     * @var \Nemundo\Process\Content\Data\ContentType\ContentTypeExternalType
     */
    public $status;

    /**
     * @var \Nemundo\Model\Type\DateTime\DateType
     */
    public $deadline;

    /**
     * @var \Nemundo\Model\Type\External\Id\ExternalUniqueIdType
     */
    public $assignmentId;

    /**
     * @var \Nemundo\Process\Group\Data\Group\GroupExternalType
     */
    public $assignment;

    /**
     * @var DateTimeType
     */
    public $dateTime;

    /**
     * @var ExternalUniqueIdType
     */
    public $userId;

    /**
     * @var UserExternalType
     */
    public $user;


    /**
     * @var \Nemundo\Model\Type\External\Id\ExternalIdType
     */
    //public $contentId;

    /**
     * @var \Nemundo\Process\Content\Data\Content\ContentExternalType
     */
    //public $content;


    public function __construct()
    {

        parent::__construct();


        $this->active = new YesNoType($this);
        $this->active->label = 'Active';
        $this->active->fieldName = 'active';
        $this->active->aliasFieldName = $this->tableName . '_active';
        $this->active->tableName = $this->tableName;
        $this->active->defaultValue = true;

        $this->number = new NumberType($this);
        $this->number->label = 'Number';
        $this->number->fieldName = 'number';
        $this->number->aliasFieldName = $this->tableName . '_number';
        $this->number->tableName = $this->tableName;

        $this->workflowNumber = new TextType($this);
        $this->workflowNumber->label = 'Workflow Number';
        $this->workflowNumber->fieldName = 'workflow_numbere';
        $this->workflowNumber->aliasFieldName = $this->tableName . '_workflow_number';
        $this->workflowNumber->tableName = $this->tableName;
        $this->workflowNumber->length = 20;


        $this->subject = new \Nemundo\Model\Type\Text\TextType($this);
        $this->subject->tableName = $this->tableName;
        $this->subject->fieldName = 'subject';
        $this->subject->aliasFieldName = $this->tableName . '_subject';
        $this->subject->label = 'Betreff';
        $this->subject->allowNullValue = false;
        $this->subject->length = 255;

        $this->workflowClosed = new \Nemundo\Model\Type\Number\YesNoType($this);
        $this->workflowClosed->tableName = $this->tableName;
        $this->workflowClosed->fieldName = 'workflow_closed';
        $this->workflowClosed->aliasFieldName = $this->tableName . '_workflow_closed';
        $this->workflowClosed->label = 'Workflow Closed';
        $this->workflowClosed->allowNullValue = false;

        $this->statusId = new \Nemundo\Model\Type\External\Id\ExternalUniqueIdType($this);
        $this->statusId->tableName = $this->tableName;
        $this->statusId->fieldName = 'status';
        $this->statusId->aliasFieldName = $this->tableName . '_status';
        $this->statusId->label = 'Status';
        $this->statusId->allowNullValue = false;

        $this->deadline = new \Nemundo\Model\Type\DateTime\DateType($this);
        $this->deadline->tableName = $this->tableName;
        $this->deadline->fieldName = 'deadline';
        $this->deadline->aliasFieldName = $this->tableName . '_deadline';
        $this->deadline->label = 'Deadline';
        $this->deadline->allowNullValue = false;

        $this->assignmentId = new \Nemundo\Model\Type\External\Id\ExternalUniqueIdType($this);
        $this->assignmentId->tableName = $this->tableName;
        $this->assignmentId->fieldName = 'assignment';
        $this->assignmentId->aliasFieldName = $this->tableName . '_assignment';
        $this->assignmentId->label = 'Zuweisung';
        $this->assignmentId->allowNullValue = false;

        $this->dateTime = new DateTimeType($this);
        $this->dateTime->tableName = $this->tableName;
        $this->dateTime->fieldName = 'date_time';
        $this->dateTime->aliasFieldName = $this->tableName . '_date_time';
        $this->dateTime->label = 'Date/Time';
        $this->dateTime->allowNullValue = false;

        $this->userId = new \Nemundo\Model\Type\External\Id\ExternalUniqueIdType($this);
        $this->userId->tableName = $this->tableName;
        $this->userId->fieldName = 'user';
        $this->userId->aliasFieldName = $this->tableName . '_user';
        $this->userId->label = 'user';
        $this->userId->allowNullValue = false;


        /*$this->contentId = new \Nemundo\Model\Type\External\Id\ExternalIdType($this);
        $this->contentId->tableName = $this->tableName;
        $this->contentId->fieldName = 'content';
        $this->contentId->aliasFieldName = $this->tableName .'_content';
        $this->contentId->label = 'Content';
        $this->contentId->allowNullValue = false;

/*
        $this->statusId = new \Nemundo\Model\Type\External\Id\ExternalUniqueIdType($this);
        $this->statusId->tableName = 'process_workflow';
        $this->statusId->fieldName = 'status';
        $this->statusId->aliasFieldName = 'process_workflow_status';
        $this->statusId->label = 'Status';
        $this->statusId->allowNullValue = false;*/


        /*$index = new \Nemundo\Model\Definition\Index\ModelIndex($this);
        $index->indexName = 'content';
        $index->addType($this->contentId);*/

        $index = new \Nemundo\Model\Definition\Index\ModelIndex($this);
        $index->indexName = 'number';
        $index->addType($this->number);

    }

    public function loadStatus()
    {
        if ($this->status == null) {
            $this->status = new ContentTypeExternalType($this, $this->tableName . '_status');
            $this->status->tableName = $this->tableName;
            $this->status->fieldName = 'status';
            $this->status->aliasFieldName = $this->tableName . '_status';
            $this->status->label = 'Status';
        }
        return $this;
    }

    public function loadAssignment()
    {
        if ($this->assignment == null) {
            $this->assignment = new \Nemundo\Process\Group\Data\Group\GroupExternalType($this, $this->tableName . '_assignment');
            $this->assignment->tableName = $this->tableName;
            $this->assignment->fieldName = 'assignment';
            $this->assignment->aliasFieldName = $this->tableName . '_assignment';
            $this->assignment->label = 'Zuweisung';
        }
        return $this;
    }

    public function loadUser()
    {
        if ($this->user == null) {
            $this->user = new UserExternalType($this, $this->tableName . '_assignment');
            $this->user->tableName = $this->tableName;
            $this->user->fieldName = 'user';
            $this->user->aliasFieldName = $this->tableName . '_user';
            $this->user->label = 'User';
        }
        return $this;
    }


    /*
    public function loadContent()
    {
        if ($this->content == null) {
            $this->content = new \Nemundo\Process\Content\Data\Content\ContentExternalType($this, 'process_workflow_content');
            $this->content->tableName = 'process_workflow';
            $this->content->fieldName = 'content';
            $this->content->aliasFieldName = 'process_workflow_content';
            $this->content->label = 'Content';
        }
    }*/

}