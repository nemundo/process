<?php
namespace Nemundo\Process\Relation\Data\Relation;
class RelationRow extends \Nemundo\Model\Row\AbstractModelDataRow {
/**
* @var \Nemundo\Model\Row\AbstractModelDataRow
*/
private $row;

/**
* @var RelationModel
*/
public $model;

/**
* @var string
*/
public $id;

/**
* @var int
*/
public $fromId;

/**
* @var \Nemundo\Process\Content\Row\ContentCustomRow
*/
public $from;

/**
* @var int
*/
public $toId;

/**
* @var \Nemundo\Process\Content\Row\ContentCustomRow
*/
public $to;

public function __construct(\Nemundo\Db\Row\AbstractDataRow $row, $model) {
parent::__construct($row->getData());
$this->row = $row;
$this->id = $this->getModelValue($model->id);
$this->fromId = intval($this->getModelValue($model->fromId));
if ($model->from !== null) {
$this->loadNemundoProcessContentDataContentContentfromRow($model->from);
}
$this->toId = intval($this->getModelValue($model->toId));
if ($model->to !== null) {
$this->loadNemundoProcessContentDataContentContenttoRow($model->to);
}
}
private function loadNemundoProcessContentDataContentContentfromRow($model) {
$this->from = new \Nemundo\Process\Content\Row\ContentCustomRow($this->row, $model);
}
private function loadNemundoProcessContentDataContentContenttoRow($model) {
$this->to = new \Nemundo\Process\Content\Row\ContentCustomRow($this->row, $model);
}
}