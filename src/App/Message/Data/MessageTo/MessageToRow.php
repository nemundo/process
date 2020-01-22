<?php
namespace Nemundo\Process\App\Message\Data\MessageTo;
class MessageToRow extends \Nemundo\Model\Row\AbstractModelDataRow {
/**
* @var \Nemundo\Model\Row\AbstractModelDataRow
*/
private $row;

/**
* @var MessageToModel
*/
public $model;

/**
* @var string
*/
public $id;

/**
* @var string
*/
public $messageId;

/**
* @var \Nemundo\Process\App\Message\Data\Message\MessageRow
*/
public $message;

/**
* @var string
*/
public $toId;

/**
* @var \Nemundo\Process\Group\Data\Group\GroupRow
*/
public $to;

public function __construct(\Nemundo\Db\Row\AbstractDataRow $row, $model) {
parent::__construct($row->getData());
$this->row = $row;
$this->id = $this->getModelValue($model->id);
$this->messageId = $this->getModelValue($model->messageId);
if ($model->message !== null) {
$this->loadNemundoProcessAppMessageDataMessageMessagemessageRow($model->message);
}
$this->toId = $this->getModelValue($model->toId);
if ($model->to !== null) {
$this->loadNemundoProcessGroupDataGroupGrouptoRow($model->to);
}
}
private function loadNemundoProcessAppMessageDataMessageMessagemessageRow($model) {
$this->message = new \Nemundo\Process\App\Message\Data\Message\MessageRow($this->row, $model);
}
private function loadNemundoProcessGroupDataGroupGrouptoRow($model) {
$this->to = new \Nemundo\Process\Group\Data\Group\GroupRow($this->row, $model);
}
}