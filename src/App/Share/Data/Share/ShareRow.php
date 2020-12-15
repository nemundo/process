<?php
namespace Nemundo\Process\App\Share\Data\Share;
class ShareRow extends \Nemundo\Model\Row\AbstractModelDataRow {
/**
* @var \Nemundo\Model\Row\AbstractModelDataRow
*/
private $row;

/**
* @var ShareModel
*/
public $model;

/**
* @var string
*/
public $id;

/**
* @var int
*/
public $toId;

/**
* @var \Nemundo\User\Data\User\UserRow
*/
public $to;

/**
* @var string
*/
public $message;

public function __construct(\Nemundo\Db\Row\AbstractDataRow $row, $model) {
parent::__construct($row->getData());
$this->row = $row;
$this->id = $this->getModelValue($model->id);
$this->toId = intval($this->getModelValue($model->toId));
if ($model->to !== null) {
$this->loadNemundoUserDataUserUsertoRow($model->to);
}
$this->message = $this->getModelValue($model->message);
}
private function loadNemundoUserDataUserUsertoRow($model) {
$this->to = new \Nemundo\User\Data\User\UserRow($this->row, $model);
}
}