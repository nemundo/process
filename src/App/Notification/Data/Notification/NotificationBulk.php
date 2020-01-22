<?php
namespace Nemundo\Process\App\Notification\Data\Notification;
class NotificationBulk extends \Nemundo\Model\Data\AbstractModelDataBulk {
/**
* @var NotificationModel
*/
protected $model;

/**
* @var bool
*/
public $archive;

/**
* @var string
*/
public $contentId;

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
public $subjectContentId;

public function __construct() {
parent::__construct();
$this->model = new NotificationModel();
}
public function save() {
$this->typeValueList->setModelValue($this->model->archive, $this->archive);
$this->typeValueList->setModelValue($this->model->contentId, $this->contentId);
$this->typeValueList->setModelValue($this->model->message, $this->message);
$this->typeValueList->setModelValue($this->model->toId, $this->toId);
$this->typeValueList->setModelValue($this->model->subjectContentId, $this->subjectContentId);
$id = parent::save();
return $id;
}
}