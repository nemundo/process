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
* @var string
*/
public $childId;

/**
* @var \Nemundo\Process\Content\Data\Document\DocumentRow
*/
public $child;

/**
* @var string
*/
public $parentId;

/**
* @var \Nemundo\Process\Content\Data\Document\DocumentRow
*/
public $parent;

public function __construct(\Nemundo\Db\Row\AbstractDataRow $row, $model) {
parent::__construct($row->getData());
$this->row = $row;
$this->id = $this->getModelValue($model->id);
$this->childId = $this->getModelValue($model->childId);
if ($model->child !== null) {
$this->loadNemundoProcessContentDataDocumentDocumentchildRow($model->child);
}
$this->parentId = $this->getModelValue($model->parentId);
if ($model->parent !== null) {
$this->loadNemundoProcessContentDataDocumentDocumentparentRow($model->parent);
}
}
private function loadNemundoProcessContentDataDocumentDocumentchildRow($model) {
$this->child = new \Nemundo\Process\Content\Data\Document\DocumentRow($this->row, $model);
}
private function loadNemundoProcessContentDataDocumentDocumentparentRow($model) {
$this->parent = new \Nemundo\Process\Content\Data\Document\DocumentRow($this->row, $model);
}
}