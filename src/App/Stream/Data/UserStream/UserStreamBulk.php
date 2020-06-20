<?php
namespace Nemundo\Process\App\Stream\Data\UserStream;
class UserStreamBulk extends \Nemundo\Model\Data\AbstractModelDataBulk {
/**
* @var UserStreamModel
*/
protected $model;

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
public function save() {
$this->typeValueList->setModelValue($this->model->userId, $this->userId);
$this->typeValueList->setModelValue($this->model->contentId, $this->contentId);
$id = parent::save();
return $id;
}
}