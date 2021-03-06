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

/**
* @var bool
*/
public $read;

/**
* @var string
*/
public $contentTypeId;

/**
* @var string
*/
public $sourceId;

/**
* @var string
*/
public $categoryId;

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
$this->typeValueList->setModelValue($this->model->read, $this->read);
$this->typeValueList->setModelValue($this->model->contentTypeId, $this->contentTypeId);
$this->typeValueList->setModelValue($this->model->sourceId, $this->sourceId);
$this->typeValueList->setModelValue($this->model->categoryId, $this->categoryId);
parent::update();
}
}