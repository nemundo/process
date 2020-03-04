<?php
namespace Nemundo\Process\App\Inbox\Data\Inbox;
use Nemundo\Model\Data\AbstractModelUpdate;
class InboxUpdate extends AbstractModelUpdate {
/**
* @var InboxModel
*/
public $model;

/**
* @var string
*/
public $userId;

/**
* @var string
*/
public $contentTypeId;

/**
* @var string
*/
public $dataId;

public function __construct() {
parent::__construct();
$this->model = new InboxModel();
}
public function update() {
$this->typeValueList->setModelValue($this->model->userId, $this->userId);
$this->typeValueList->setModelValue($this->model->contentTypeId, $this->contentTypeId);
$this->typeValueList->setModelValue($this->model->dataId, $this->dataId);
parent::update();
}
}