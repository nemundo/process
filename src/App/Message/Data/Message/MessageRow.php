<?php
namespace Nemundo\Process\App\Message\Data\Message;
class MessageRow extends \Nemundo\Model\Row\AbstractModelDataRow {
/**
* @var \Nemundo\Model\Row\AbstractModelDataRow
*/
private $row;

/**
* @var MessageModel
*/
public $model;

/**
* @var string
*/
public $id;

/**
* @var string
*/
public $subject;

/**
* @var string
*/
public $message;

public function __construct(\Nemundo\Db\Row\AbstractDataRow $row, $model) {
parent::__construct($row->getData());
$this->row = $row;
$this->id = $this->getModelValue($model->id);
$this->subject = $this->getModelValue($model->subject);
$this->message = $this->getModelValue($model->message);
}
}