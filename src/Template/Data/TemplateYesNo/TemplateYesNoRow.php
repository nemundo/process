<?php
namespace Nemundo\Process\Template\Data\TemplateYesNo;
class TemplateYesNoRow extends \Nemundo\Model\Row\AbstractModelDataRow {
/**
* @var \Nemundo\Model\Row\AbstractModelDataRow
*/
private $row;

/**
* @var TemplateYesNoModel
*/
public $model;

/**
* @var string
*/
public $id;

/**
* @var bool
*/
public $yesNo;

public function __construct(\Nemundo\Db\Row\AbstractDataRow $row, $model) {
parent::__construct($row->getData());
$this->row = $row;
$this->id = $this->getModelValue($model->id);
$this->yesNo = boolval($this->getModelValue($model->yesNo));
}
}