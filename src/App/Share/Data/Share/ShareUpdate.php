<?php
namespace Nemundo\Process\App\Share\Data\Share;
use Nemundo\Model\Data\AbstractModelUpdate;
class ShareUpdate extends AbstractModelUpdate {
/**
* @var ShareModel
*/
public $model;

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
public function update() {
$this->typeValueList->setModelValue($this->model->toId, $this->toId);
$this->typeValueList->setModelValue($this->model->message, $this->message);
parent::update();
}
}