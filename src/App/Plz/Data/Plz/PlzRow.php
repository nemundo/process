<?php
namespace Nemundo\Process\App\Plz\Data\Plz;
class PlzRow extends \Nemundo\Model\Row\AbstractModelDataRow {
/**
* @var \Nemundo\Model\Row\AbstractModelDataRow
*/
private $row;

/**
* @var PlzModel
*/
public $model;

/**
* @var string
*/
public $id;

/**
* @var string
*/
public $plz;

/**
* @var string
*/
public $ort;

public function __construct(\Nemundo\Db\Row\AbstractDataRow $row, $model) {
parent::__construct($row->getData());
$this->row = $row;
$this->id = $this->getModelValue($model->id);
$this->plz = $this->getModelValue($model->plz);
$this->ort = $this->getModelValue($model->ort);
}
}