<?php
namespace Nemundo\Process\Workflow\Data\Workflow;
class WorkflowRow extends \Nemundo\Model\Row\AbstractModelDataRow {
/**
* @var \Nemundo\Model\Row\AbstractModelDataRow
*/
private $row;

/**
* @var WorkflowModel
*/
public $model;

/**
* @var string
*/
public $id;

/**
* @var int
*/
public $number;

/**
* @var string
*/
public $workflowNumber;

/**
* @var string
*/
public $subject;

/**
* @var bool
*/
public $workflowClosed;

/**
* @var string
*/
public $statusId;

/**
* @var \Nemundo\Process\Content\Row\ContentTypeCustomRow
*/
public $status;

/**
* @var \Nemundo\Core\Type\DateTime\Date
*/
public $deadline;

/**
* @var string
*/
public $assignmentId;

/**
* @var \Nemundo\Process\Group\Data\Group\GroupRow
*/
public $assignment;

/**
* @var string
*/
public $contentId;

/**
* @var \Nemundo\Process\Content\Row\ContentCustomRow
*/
public $content;

public function __construct(\Nemundo\Db\Row\AbstractDataRow $row, $model) {
parent::__construct($row->getData());
$this->row = $row;
$this->id = $this->getModelValue($model->id);
$this->number = intval($this->getModelValue($model->number));
$this->workflowNumber = $this->getModelValue($model->workflowNumber);
$this->subject = $this->getModelValue($model->subject);
$this->workflowClosed = boolval($this->getModelValue($model->workflowClosed));
$this->statusId = $this->getModelValue($model->statusId);
if ($model->status !== null) {
$this->loadNemundoProcessContentDataContentTypeContentTypestatusRow($model->status);
}
$value = $this->getModelValue($model->deadline);
if ($value !== "0000-00-00") {
$this->deadline = new \Nemundo\Core\Type\DateTime\Date($this->getModelValue($model->deadline));
}
$this->assignmentId = $this->getModelValue($model->assignmentId);
if ($model->assignment !== null) {
$this->loadNemundoProcessGroupDataGroupGroupassignmentRow($model->assignment);
}
$this->contentId = $this->getModelValue($model->contentId);
if ($model->content !== null) {
$this->loadNemundoProcessContentDataContentContentcontentRow($model->content);
}
}
private function loadNemundoProcessContentDataContentTypeContentTypestatusRow($model) {
$this->status = new \Nemundo\Process\Content\Row\ContentTypeCustomRow($this->row, $model);
}
private function loadNemundoProcessGroupDataGroupGroupassignmentRow($model) {
$this->assignment = new \Nemundo\Process\Group\Data\Group\GroupRow($this->row, $model);
}
private function loadNemundoProcessContentDataContentContentcontentRow($model) {
$this->content = new \Nemundo\Process\Content\Row\ContentCustomRow($this->row, $model);
}
}