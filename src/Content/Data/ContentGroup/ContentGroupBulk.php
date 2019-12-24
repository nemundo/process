<?php
namespace Nemundo\Process\Content\Data\ContentGroup;
class ContentGroupBulk extends \Nemundo\Model\Data\AbstractModelDataBulk {
/**
* @var ContentGroupModel
*/
protected $model;

/**
* @var string
*/
public $contentId;

/**
* @var string
*/
public $groupId;

public function __construct() {
parent::__construct();
$this->model = new ContentGroupModel();
}
public function save() {
$this->typeValueList->setModelValue($this->model->contentId, $this->contentId);
$this->typeValueList->setModelValue($this->model->groupId, $this->groupId);
$id = parent::save();
return $id;
}
}