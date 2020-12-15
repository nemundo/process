<?php
namespace Nemundo\Process\App\Stream\Data\UserStream;
class UserStreamRow extends \Nemundo\Model\Row\AbstractModelDataRow {
/**
* @var \Nemundo\Model\Row\AbstractModelDataRow
*/
private $row;

/**
* @var UserStreamModel
*/
public $model;

/**
* @var string
*/
public $id;

/**
* @var int
*/
public $userId;

/**
* @var \Nemundo\User\Data\User\UserRow
*/
public $user;

/**
* @var int
*/
public $contentId;

/**
* @var \Nemundo\Process\Content\Row\ContentCustomRow
*/
public $content;

public function __construct(\Nemundo\Db\Row\AbstractDataRow $row, $model) {
parent::__construct($row->getData());
$this->row = $row;
$this->id = $this->getModelValue($model->id);
$this->userId = intval($this->getModelValue($model->userId));
if ($model->user !== null) {
$this->loadNemundoUserDataUserUseruserRow($model->user);
}
$this->contentId = intval($this->getModelValue($model->contentId));
if ($model->content !== null) {
$this->loadNemundoProcessContentDataContentContentcontentRow($model->content);
}
}
private function loadNemundoUserDataUserUseruserRow($model) {
$this->user = new \Nemundo\User\Data\User\UserRow($this->row, $model);
}
private function loadNemundoProcessContentDataContentContentcontentRow($model) {
$this->content = new \Nemundo\Process\Content\Row\ContentCustomRow($this->row, $model);
}
}