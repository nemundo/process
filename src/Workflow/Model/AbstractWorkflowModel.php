<?php


namespace Nemundo\Process\Workflow\Model;


use Nemundo\Core\Language\LanguageCode;
use Nemundo\Model\Definition\Index\ModelIndex;
use Nemundo\Model\Definition\Index\ModelUniqueIndex;
use Nemundo\Model\Definition\Model\AbstractModel;
use Nemundo\Model\Type\DateTime\DateTimeType;
use Nemundo\Model\Type\DateTime\DateType;
use Nemundo\Model\Type\External\Id\ExternalIdType;
use Nemundo\Model\Type\External\Id\ExternalUniqueIdType;
use Nemundo\Model\Type\Number\NumberType;
use Nemundo\Model\Type\Number\YesNoType;
use Nemundo\Model\Type\Text\TextType;
use Nemundo\Process\Content\Data\Content\ContentExternalType;
use Nemundo\Process\Group\Data\Group\GroupExternalType;
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
     * @var TextType
     */
    public $subject;

    /**
     * @var YesNoType
     */
    public $workflowClosed;

    /**
     * @var ExternalUniqueIdType
     */
    public $statusId;


    // ContentTypeExternalType
    /**
     * @var ContentExternalType
     */
    public $status;

    /**
     * @var DateType
     */
    public $deadline;

    /**
     * @var ExternalUniqueIdType
     */
    public $assignmentId;

    /**
     * @var GroupExternalType
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
     * @var ExternalIdType
     */
    public $contentId;

    /**
     * @var ContentExternalType
     */
    public $content;


    public function __construct()
    {

        parent::__construct();

        $this->active = new YesNoType($this);
        $this->active->label = 'Active';
        $this->active->fieldName = 'active';
        $this->active->aliasFieldName = $this->tableName . '_active';
        $this->active->tableName = $this->tableName;
        $this->active->allowNullValue = true;

        $this->number = new NumberType($this);
        $this->number->label = 'Number';
        $this->number->fieldName = 'number';
        $this->number->aliasFieldName = $this->tableName . '_number';
        $this->number->tableName = $this->tableName;
        $this->number->allowNullValue = true;

        $this->workflowNumber = new TextType($this);
        $this->workflowNumber->label[LanguageCode::EN] = 'Workflow Number';
        $this->workflowNumber->label[LanguageCode::DE] = 'Nr.';
        $this->workflowNumber->fieldName = 'workflow_number';
        $this->workflowNumber->aliasFieldName = $this->tableName . '_workflow_number';
        $this->workflowNumber->tableName = $this->tableName;
        $this->workflowNumber->length = 20;
        $this->workflowNumber->allowNullValue = true;

        $this->subject = new TextType($this);
        $this->subject->tableName = $this->tableName;
        $this->subject->fieldName = 'subject';
        $this->subject->aliasFieldName = $this->tableName . '_subject';
        $this->subject->label[LanguageCode::EN] = 'Subject';
        $this->subject->label[LanguageCode::DE] = 'Betreff';
        $this->subject->allowNullValue = true;
        $this->subject->length = 255;

        $this->workflowClosed = new YesNoType($this);
        $this->workflowClosed->tableName = $this->tableName;
        $this->workflowClosed->fieldName = 'workflow_closed';
        $this->workflowClosed->aliasFieldName = $this->tableName . '_workflow_closed';
        $this->workflowClosed->label = 'Workflow Closed';
        $this->workflowClosed->allowNullValue = true;

        $this->statusId = new ExternalUniqueIdType($this);
        $this->statusId->tableName = $this->tableName;
        $this->statusId->fieldName = 'status';
        $this->statusId->aliasFieldName = $this->tableName . '_status';
        $this->statusId->label = 'Status';
        $this->statusId->allowNullValue = true;

        $this->deadline = new DateType($this);
        $this->deadline->tableName = $this->tableName;
        $this->deadline->fieldName = 'deadline';
        $this->deadline->aliasFieldName = $this->tableName . '_deadline';
        $this->deadline->label[LanguageCode::EN] = 'Deadline';
        $this->deadline->label[LanguageCode::DE] = 'Erledigen bis';
        $this->deadline->allowNullValue = true;

        $this->assignmentId = new ExternalUniqueIdType($this);
        $this->assignmentId->tableName = $this->tableName;
        $this->assignmentId->fieldName = 'assignment';
        $this->assignmentId->aliasFieldName = $this->tableName . '_assignment';
        $this->assignmentId->label = 'Zuweisung';
        $this->assignmentId->allowNullValue = true;

        $this->dateTime = new DateTimeType($this);
        $this->dateTime->tableName = $this->tableName;
        $this->dateTime->fieldName = 'date_time';
        $this->dateTime->aliasFieldName = $this->tableName . '_date_time';
        $this->dateTime->label = 'Date/Time';
        $this->dateTime->allowNullValue = true;

        $this->userId = new ExternalUniqueIdType($this);
        $this->userId->tableName = $this->tableName;
        $this->userId->fieldName = 'user';
        $this->userId->aliasFieldName = $this->tableName . '_user';
        $this->userId->label = 'user';
        $this->userId->allowNullValue = true;

        $this->contentId = new ExternalIdType($this);
        $this->contentId->tableName = $this->tableName;
        $this->contentId->fieldName = 'content';
        $this->contentId->aliasFieldName = $this->tableName . '_content';
        $this->contentId->label = 'Content';
        $this->contentId->allowNullValue = true;

        $index = new ModelUniqueIndex($this);
        $index->indexName = 'number';
        $index->addType($this->number);

        $index = new ModelIndex($this);
        $index->indexName = 'content';
        $index->addType($this->contentId);

    }

    public function loadStatus()
    {
        if ($this->status == null) {
            $this->status = new ContentExternalType($this, $this->tableName . '_status');
            $this->status->tableName = $this->tableName;
            $this->status->fieldName = 'status';
            $this->status->aliasFieldName = $this->tableName . '_status';
            $this->status->label = 'Status';
            $this->status->loadContentType();
        }
        return $this;
    }

    public function loadAssignment()
    {
        if ($this->assignment == null) {
            $this->assignment = new GroupExternalType($this, $this->tableName . '_assignment');
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


    public function loadContent()
    {
        if ($this->content == null) {
            $this->content = new ContentExternalType($this, $this->tableName . '_content');
            $this->content->tableName = $this->tableName;
            $this->content->fieldName = 'content';
            $this->content->aliasFieldName = $this->tableName . '_content';
            $this->content->label = 'Content';
        }
        return $this;
    }

}