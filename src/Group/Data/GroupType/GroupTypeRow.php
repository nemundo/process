<?php
namespace Nemundo\Process\Group\Data\GroupType;
class GroupTypeRow extends \Nemundo\Model\Row\AbstractModelDataRow {
/**
* @var \Nemundo\Model\Row\AbstractModelDataRow
*/
private $row;

/**
* @var GroupTypeModel
*/
public $model;

/**
* @var string
*/
public $id;

/**
* @var string
*/
public $groupTypeId;

/**
* @var \Nemundo\Process\Content\Row\ContentTypeCustomRow
*/
public $groupType;

public function __construct(\Nemundo\Db\Row\AbstractDataRow $row, $model) {
parent::__construct($row->getData());
$this->row = $row;
$this->id = $this->getModelValue($model->id);
$this->groupTypeId = $this->getModelValue($model->groupTypeId);
if ($model->groupType !== null) {
$this->loadNemundoProcessContentDataContentTypeContentTypegroupTypeRow($model->groupType);
}
}
private function loadNemundoProcessContentDataContentTypeContentTypegroupTypeRow($model) {
$this->groupType = new \Nemundo\Process\Content\Row\ContentTypeCustomRow($this->row, $model);
}
}