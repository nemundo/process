<?php
namespace Nemundo\Process\App\Inbox\Data\Inbox;
class Inbox extends \Nemundo\Model\Data\AbstractModelData {
/**
* @var InboxModel
*/
protected $model;

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
public function save() {
$this->typeValueList->setModelValue($this->model->userId, $this->userId);
$this->typeValueList->setModelValue($this->model->contentTypeId, $this->contentTypeId);
$this->typeValueList->setModelValue($this->model->dataId, $this->dataId);
$id = parent::save();
return $id;
}
}