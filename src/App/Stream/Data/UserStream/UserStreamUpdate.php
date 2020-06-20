<?php
namespace Nemundo\Process\App\Stream\Data\UserStream;
use Nemundo\Model\Data\AbstractModelUpdate;
class UserStreamUpdate extends AbstractModelUpdate {
/**
* @var UserStreamModel
*/
public $model;

/**
* @var string
*/
public $userId;

/**
* @var string
*/
public $contentId;

public function __construct() {
parent::__construct();
$this->model = new UserStreamModel();
}
public function update() {
$this->typeValueList->setModelValue($this->model->userId, $this->userId);
$this->typeValueList->setModelValue($this->model->contentId, $this->contentId);
parent::update();
}
}