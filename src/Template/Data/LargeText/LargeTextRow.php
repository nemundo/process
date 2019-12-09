<?php
namespace Nemundo\Process\Template\Data\LargeText;
class LargeTextRow extends \Nemundo\Model\Row\AbstractModelDataRow {
/**
* @var \Nemundo\Model\Row\AbstractModelDataRow
*/
private $row;

/**
* @var LargeTextModel
*/
public $model;

/**
* @var string
*/
public $id;

/**
* @var string
*/
public $largeText;

public function __construct(\Nemundo\Db\Row\AbstractDataRow $row, $model) {
parent::__construct($row->getData());
$this->row = $row;
$this->id = $this->getModelValue($model->id);
$this->largeText = $this->getModelValue($model->largeText);
}
}