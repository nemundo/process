<?php
namespace Nemundo\Process\Content\Data\ContentStatus;
class ContentStatusRow extends \Nemundo\Model\Row\AbstractModelDataRow {
/**
* @var \Nemundo\Model\Row\AbstractModelDataRow
*/
private $row;

/**
* @var ContentStatusModel
*/
public $model;

/**
* @var string
*/
public $id;

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
public $statusId;

/**
* @var \Nemundo\Process\Content\Row\ContentTypeCustomRow
*/
public $status;

public function __construct(\Nemundo\Db\Row\AbstractDataRow $row, $model) {
parent::__construct($row->getData());
$this->row = $row;
$this->id = $this->getModelValue($model->id);
$this->contentId = intval($this->getModelValue($model->contentId));
if ($model->content !== null) {
$this->loadNemundoProcessContentDataContentContentcontentRow($model->content);
}
$this->statusId = $this->getModelValue($model->statusId);
if ($model->status !== null) {
$this->loadNemundoProcessContentDataContentTypeContentTypestatusRow($model->status);
}
}
private function loadNemundoProcessContentDataContentContentcontentRow($model) {
$this->content = new \Nemundo\Process\Content\Row\ContentCustomRow($this->row, $model);
}
private function loadNemundoProcessContentDataContentTypeContentTypestatusRow($model) {
$this->status = new \Nemundo\Process\Content\Row\ContentTypeCustomRow($this->row, $model);
}
}