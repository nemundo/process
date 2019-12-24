<?php
namespace Nemundo\Process\Content\Data\ContentGroup;
use Nemundo\Model\Data\AbstractModelUpdate;
class ContentGroupUpdate extends AbstractModelUpdate {
/**
* @var ContentGroupModel
*/
public $model;

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
public function update() {
$this->typeValueList->setModelValue($this->model->contentId, $this->contentId);
$this->typeValueList->setModelValue($this->model->groupId, $this->groupId);
parent::update();
}
}