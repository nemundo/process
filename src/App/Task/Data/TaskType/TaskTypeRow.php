<?php
namespace Nemundo\Process\App\Task\Data\TaskType;
class TaskTypeRow extends \Nemundo\Model\Row\AbstractModelDataRow {
/**
* @var \Nemundo\Model\Row\AbstractModelDataRow
*/
private $row;

/**
* @var TaskTypeModel
*/
public $model;

/**
* @var string
*/
public $id;

/**
* @var string
*/
public $taskTypeId;

/**
* @var \Nemundo\Process\Content\Row\ContentTypeCustomRow
*/
public $taskType;

public function __construct(\Nemundo\Db\Row\AbstractDataRow $row, $model) {
parent::__construct($row->getData());
$this->row = $row;
$this->id = $this->getModelValue($model->id);
$this->taskTypeId = $this->getModelValue($model->taskTypeId);
if ($model->taskType !== null) {
$this->loadNemundoProcessContentDataContentTypeContentTypetaskTypeRow($model->taskType);
}
}
private function loadNemundoProcessContentDataContentTypeContentTypetaskTypeRow($model) {
$this->taskType = new \Nemundo\Process\Content\Row\ContentTypeCustomRow($this->row, $model);
}
}