<?php
namespace Nemundo\Process\Template\Data\TemplateImageIndex;
class TemplateImageIndexRow extends \Nemundo\Model\Row\AbstractModelDataRow {
/**
* @var \Nemundo\Model\Row\AbstractModelDataRow
*/
private $row;

/**
* @var TemplateImageIndexModel
*/
public $model;

/**
* @var string
*/
public $id;

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
public $contentId;

/**
* @var \Nemundo\Process\Content\Row\ContentCustomRow
*/
public $content;

/**
* @var string
*/
public $urlSmall;

/**
* @var string
*/
public $urlLarge;

/**
* @var int
*/
public $itemOrder;

public function __construct(\Nemundo\Db\Row\AbstractDataRow $row, $model) {
parent::__construct($row->getData());
$this->row = $row;
$this->id = $this->getModelValue($model->id);
$this->parentId = intval($this->getModelValue($model->parentId));
if ($model->parent !== null) {
$this->loadNemundoProcessContentDataContentContentparentRow($model->parent);
}
$this->contentId = intval($this->getModelValue($model->contentId));
if ($model->content !== null) {
$this->loadNemundoProcessContentDataContentContentcontentRow($model->content);
}
$this->urlSmall = $this->getModelValue($model->urlSmall);
$this->urlLarge = $this->getModelValue($model->urlLarge);
$this->itemOrder = intval($this->getModelValue($model->itemOrder));
}
private function loadNemundoProcessContentDataContentContentparentRow($model) {
$this->parent = new \Nemundo\Process\Content\Row\ContentCustomRow($this->row, $model);
}
private function loadNemundoProcessContentDataContentContentcontentRow($model) {
$this->content = new \Nemundo\Process\Content\Row\ContentCustomRow($this->row, $model);
}
}