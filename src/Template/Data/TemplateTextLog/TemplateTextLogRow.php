<?php
namespace Nemundo\Process\Template\Data\TemplateTextLog;
class TemplateTextLogRow extends \Nemundo\Model\Row\AbstractModelDataRow {
/**
* @var \Nemundo\Model\Row\AbstractModelDataRow
*/
private $row;

/**
* @var TemplateTextLogModel
*/
public $model;

/**
* @var string
*/
public $id;

/**
* @var string
*/
public $textFrom;

/**
* @var string
*/
public $textTo;

public function __construct(\Nemundo\Db\Row\AbstractDataRow $row, $model) {
parent::__construct($row->getData());
$this->row = $row;
$this->id = $this->getModelValue($model->id);
$this->textFrom = $this->getModelValue($model->textFrom);
$this->textTo = $this->getModelValue($model->textTo);
}
}