<?php
namespace Nemundo\Process\App\Share\Data\Share;
class ShareBulk extends \Nemundo\Model\Data\AbstractModelDataBulk {
/**
* @var ShareModel
*/
protected $model;

/**
* @var string
*/
public $toId;

/**
* @var string
*/
public $message;

public function __construct() {
parent::__construct();
$this->model = new ShareModel();
}
public function save() {
$this->typeValueList->setModelValue($this->model->toId, $this->toId);
$this->typeValueList->setModelValue($this->model->message, $this->message);
$id = parent::save();
return $id;
}
}