<?php
namespace Nemundo\Process\Content\Data\ContentStatus;
class ContentStatus extends \Nemundo\Model\Data\AbstractModelData {
/**
* @var ContentStatusModel
*/
protected $model;

/**
* @var string
*/
public $contentId;

/**
* @var string
*/
public $statusId;

public function __construct() {
parent::__construct();
$this->model = new ContentStatusModel();
}
public function save() {
$this->typeValueList->setModelValue($this->model->contentId, $this->contentId);
$this->typeValueList->setModelValue($this->model->statusId, $this->statusId);
$id = parent::save();
return $id;
}
}