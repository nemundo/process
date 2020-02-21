<?php
namespace Nemundo\Process\Content\Data\Tree;
class TreeRow extends \Nemundo\Model\Row\AbstractModelDataRow {
/**
* @var \Nemundo\Model\Row\AbstractModelDataRow
*/
private $row;

/**
* @var TreeModel
*/
public $model;

/**
* @var string
*/
public $id;

/**
* @var int
*/
public $childId;

/**
* @var \Nemundo\Process\Content\Row\ContentCustomRow
*/
public $child;

/**
* @var int
*/
public $parentId;

/**
* @var \Nemundo\Process\Content\Row\ContentCustomRow
*/
public $parent;

/**
* @var int
*/
public $itemOrder;

public function __construct(\Nemundo\Db\Row\AbstractDataRow $row, $model) {
parent::__construct($row->getData());
$this->row = $row;
$this->id = $this->getModelValue($model->id);
$this->childId = intval($this->getModelValue($model->childId));
if ($model->child !== null) {
$this->loadNemundoProcessContentDataContentContentchildRow($model->child);
}
$this->parentId = intval($this->getModelValue($model->parentId));
if ($model->parent !== null) {
$this->loadNemundoProcessContentDataContentContentparentRow($model->parent);
}
$this->itemOrder = intval($this->getModelValue($model->itemOrder));
}
private function loadNemundoProcessContentDataContentContentchildRow($model) {
$this->child = new \Nemundo\Process\Content\Row\ContentCustomRow($this->row, $model);
}
private function loadNemundoProcessContentDataContentContentparentRow($model) {
$this->parent = new \Nemundo\Process\Content\Row\ContentCustomRow($this->row, $model);
}
}