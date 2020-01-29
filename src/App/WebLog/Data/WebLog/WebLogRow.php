<?php
namespace Nemundo\Process\App\WebLog\Data\WebLog;
class WebLogRow extends \Nemundo\Model\Row\AbstractModelDataRow {
/**
* @var \Nemundo\Model\Row\AbstractModelDataRow
*/
private $row;

/**
* @var WebLogModel
*/
public $model;

/**
* @var string
*/
public $id;

public function __construct(\Nemundo\Db\Row\AbstractDataRow $row, $model) {
parent::__construct($row->getData());
$this->row = $row;
$this->id = $this->getModelValue($model->id);
}
}