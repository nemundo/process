<?php
namespace Nemundo\Process\Content\Data\ContentGroup;
class ContentGroupRow extends \Nemundo\Model\Row\AbstractModelDataRow {
/**
* @var \Nemundo\Model\Row\AbstractModelDataRow
*/
private $row;

/**
* @var ContentGroupModel
*/
public $model;

/**
* @var string
*/
public $id;

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
public $groupId;

/**
* @var \Nemundo\Process\Group\Row\GroupCustomRow
*/
public $group;

public function __construct(\Nemundo\Db\Row\AbstractDataRow $row, $model) {
parent::__construct($row->getData());
$this->row = $row;
$this->id = $this->getModelValue($model->id);
$this->contentId = intval($this->getModelValue($model->contentId));
if ($model->content !== null) {
$this->loadNemundoProcessContentDataContentContentcontentRow($model->content);
}
$this->groupId = $this->getModelValue($model->groupId);
if ($model->group !== null) {
$this->loadNemundoProcessGroupDataGroupGroupgroupRow($model->group);
}
}
private function loadNemundoProcessContentDataContentContentcontentRow($model) {
$this->content = new \Nemundo\Process\Content\Row\ContentCustomRow($this->row, $model);
}
private function loadNemundoProcessGroupDataGroupGroupgroupRow($model) {
$this->group = new \Nemundo\Process\Group\Row\GroupCustomRow($this->row, $model);
}
}