<?php
namespace Nemundo\Process\Content\Data\ContentStatus;
use Nemundo\Model\Data\AbstractModelUpdate;
class ContentStatusUpdate extends AbstractModelUpdate {
/**
* @var ContentStatusModel
*/
public $model;

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
public function update() {
$this->typeValueList->setModelValue($this->model->contentId, $this->contentId);
$this->typeValueList->setModelValue($this->model->statusId, $this->statusId);
parent::update();
}
}