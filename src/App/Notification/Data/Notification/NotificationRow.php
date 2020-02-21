<?php
namespace Nemundo\Process\App\Notification\Data\Notification;
class NotificationRow extends \Nemundo\Model\Row\AbstractModelDataRow {
/**
* @var \Nemundo\Model\Row\AbstractModelDataRow
*/
private $row;

/**
* @var NotificationModel
*/
public $model;

/**
* @var string
*/
public $id;

/**
* @var bool
*/
public $archive;

/**
* @var int
*/
public $contentId;

/**
* @var \Nemundo\Process\Content\Row\ContentCustomRow
*/
public $content;

/**
* @var string
*/
public $message;

/**
* @var string
*/
public $toId;

/**
* @var \Nemundo\User\Data\User\UserRow
*/
public $to;

/**
* @var int
*/
public $subjectContentId;

/**
* @var \Nemundo\Process\Content\Row\ContentCustomRow
*/
public $subjectContent;

public function __construct(\Nemundo\Db\Row\AbstractDataRow $row, $model) {
parent::__construct($row->getData());
$this->row = $row;
$this->id = $this->getModelValue($model->id);
$this->archive = boolval($this->getModelValue($model->archive));
$this->contentId = intval($this->getModelValue($model->contentId));
if ($model->content !== null) {
$this->loadNemundoProcessContentDataContentContentcontentRow($model->content);
}
$this->message = $this->getModelValue($model->message);
$this->toId = $this->getModelValue($model->toId);
if ($model->to !== null) {
$this->loadNemundoUserDataUserUsertoRow($model->to);
}
$this->subjectContentId = intval($this->getModelValue($model->subjectContentId));
if ($model->subjectContent !== null) {
$this->loadNemundoProcessContentDataContentContentsubjectContentRow($model->subjectContent);
}
}
private function loadNemundoProcessContentDataContentContentcontentRow($model) {
$this->content = new \Nemundo\Process\Content\Row\ContentCustomRow($this->row, $model);
}
private function loadNemundoUserDataUserUsertoRow($model) {
$this->to = new \Nemundo\User\Data\User\UserRow($this->row, $model);
}
private function loadNemundoProcessContentDataContentContentsubjectContentRow($model) {
$this->subjectContent = new \Nemundo\Process\Content\Row\ContentCustomRow($this->row, $model);
}
}