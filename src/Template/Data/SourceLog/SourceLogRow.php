<?php
namespace Nemundo\Process\Template\Data\SourceLog;
class SourceLogRow extends \Nemundo\Model\Row\AbstractModelDataRow {
/**
* @var \Nemundo\Model\Row\AbstractModelDataRow
*/
private $row;

/**
* @var SourceLogModel
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

public function __construct(\Nemundo\Db\Row\AbstractDataRow $row, $model) {
parent::__construct($row->getData());
$this->row = $row;
$this->id = $this->getModelValue($model->id);
$this->sourceId = intval($this->getModelValue($model->sourceId));
if ($model->source !== null) {
$this->loadNemundoProcessContentDataContentContentsourceRow($model->source);
}
}
private function loadNemundoProcessContentDataContentContentsourceRow($model) {
$this->source = new \Nemundo\Process\Content\Row\ContentCustomRow($this->row, $model);
}
}