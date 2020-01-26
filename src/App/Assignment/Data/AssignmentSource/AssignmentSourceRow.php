<?php
namespace Nemundo\Process\App\Assignment\Data\AssignmentSource;
class AssignmentSourceRow extends \Nemundo\Model\Row\AbstractModelDataRow {
/**
* @var \Nemundo\Model\Row\AbstractModelDataRow
*/
private $row;

/**
* @var AssignmentSourceModel
*/
public $model;

/**
* @var string
*/
public $id;

/**
* @var string
*/
public $sourceId;

/**
* @var \Nemundo\Process\Content\Row\ContentTypeCustomRow
*/
public $source;

public function __construct(\Nemundo\Db\Row\AbstractDataRow $row, $model) {
parent::__construct($row->getData());
$this->row = $row;
$this->id = $this->getModelValue($model->id);
$this->sourceId = $this->getModelValue($model->sourceId);
if ($model->source !== null) {
$this->loadNemundoProcessContentDataContentTypeContentTypesourceRow($model->source);
}
}
private function loadNemundoProcessContentDataContentTypeContentTypesourceRow($model) {
$this->source = new \Nemundo\Process\Content\Row\ContentTypeCustomRow($this->row, $model);
}
}