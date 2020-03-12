<?php
namespace Nemundo\Process\App\Notification\Data\Notification;
use Nemundo\Model\Data\AbstractModelUpdate;
class NotificationUpdate extends AbstractModelUpdate {
/**
* @var NotificationModel
*/
public $model;

/**
* @var bool
*/
public $archive;

/**
* @var string
*/
public $message;

/**
* @var string
*/
public $toId;

/**
* @var string
*/
public $contentId;

/**
* @var string
*/
public $subject;

public function __construct() {
parent::__construct();
$this->model = new NotificationModel();
}
public function update() {
$this->typeValueList->setModelValue($this->model->archive, $this->archive);
$this->typeValueList->setModelValue($this->model->message, $this->message);
$this->typeValueList->setModelValue($this->model->toId, $this->toId);
$this->typeValueList->setModelValue($this->model->contentId, $this->contentId);
$this->typeValueList->setModelValue($this->model->subject, $this->subject);
parent::update();
}
}