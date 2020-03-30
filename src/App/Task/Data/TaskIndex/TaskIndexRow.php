<?php
namespace Nemundo\Process\App\Task\Data\TaskIndex;
class TaskIndexRow extends \Nemundo\Model\Row\AbstractModelDataRow {
/**
* @var \Nemundo\Model\Row\AbstractModelDataRow
*/
private $row;

/**
* @var TaskIndexModel
*/
public $model;

/**
* @var string
*/
public $id;

/**
* @var int
*/
public $sourceId;

/**
* @var \Nemundo\Process\Content\Row\ContentCustomRow
*/
public $source;

/**
* @var int
*/
public $contentId;

/**
* @var \Nemundo\Process\Content\Row\ContentCustomRow
*/
public $content;

/**
* @var string
*/
public $subject;

/**
* @var string
*/
public $assignmentId;

/**
* @var \Nemundo\Process\Group\Row\GroupCustomRow
*/
public $assignment;

/**
* @var \Nemundo\Core\Type\DateTime\Date
*/
public $deadline;

/**
* @var string
*/
public $userId;

/**
* @var \Nemundo\User\Data\User\UserRow
*/
public $user;

/**
* @var \Nemundo\Core\Type\DateTime\DateTime
*/
public $dateTime;

/**
* @var bool
*/
public $closed;

/**
* @var string
*/
public $taskTypeId;

/**
* @var \Nemundo\Process\Content\Row\ContentTypeCustomRow
*/
public $taskType;

/**
* @var bool
*/
public $updateStatus;

/**
* @var bool
*/
public $hasSource;

public function __construct(\Nemundo\Db\Row\AbstractDataRow $row, $model) {
parent::__construct($row->getData());
$this->row = $row;
$this->id = $this->getModelValue($model->id);
$this->sourceId = intval($this->getModelValue($model->sourceId));
if ($model->source !== null) {
$this->loadNemundoProcessContentDataContentContentsourceRow($model->source);
}
$this->contentId = intval($this->getModelValue($model->contentId));
if ($model->content !== null) {
$this->loadNemundoProcessContentDataContentContentcontentRow($model->content);
}
$this->subject = $this->getModelValue($model->subject);
$this->assignmentId = $this->getModelValue($model->assignmentId);
if ($model->assignment !== null) {
$this->loadNemundoProcessGroupDataGroupGroupassignmentRow($model->assignment);
}
$value = $this->getModelValue($model->deadline);
if ($value !== "0000-00-00") {
$this->deadline = new \Nemundo\Core\Type\DateTime\Date($this->getModelValue($model->deadline));
}
$this->userId = $this->getModelValue($model->userId);
if ($model->user !== null) {
$this->loadNemundoUserDataUserUseruserRow($model->user);
}
$this->dateTime = new \Nemundo\Core\Type\DateTime\DateTime($this->getModelValue($model->dateTime));
$this->closed = boolval($this->getModelValue($model->closed));
$this->taskTypeId = $this->getModelValue($model->taskTypeId);
if ($model->taskType !== null) {
$this->loadNemundoProcessContentDataContentTypeContentTypetaskTypeRow($model->taskType);
}
$this->updateStatus = boolval($this->getModelValue($model->updateStatus));
$this->hasSource = boolval($this->getModelValue($model->hasSource));
}
private function loadNemundoProcessContentDataContentContentsourceRow($model) {
$this->source = new \Nemundo\Process\Content\Row\ContentCustomRow($this->row, $model);
}
private function loadNemundoProcessContentDataContentContentcontentRow($model) {
$this->content = new \Nemundo\Process\Content\Row\ContentCustomRow($this->row, $model);
}
private function loadNemundoProcessGroupDataGroupGroupassignmentRow($model) {
$this->assignment = new \Nemundo\Process\Group\Row\GroupCustomRow($this->row, $model);
}
private function loadNemundoUserDataUserUseruserRow($model) {
$this->user = new \Nemundo\User\Data\User\UserRow($this->row, $model);
}
private function loadNemundoProcessContentDataContentTypeContentTypetaskTypeRow($model) {
$this->taskType = new \Nemundo\Process\Content\Row\ContentTypeCustomRow($this->row, $model);
}
}