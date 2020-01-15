<?php
namespace Nemundo\Process\App\Plz\Data\Plz;
class PlzBulk extends \Nemundo\Model\Data\AbstractModelDataBulk {
/**
* @var PlzModel
*/
protected $model;

/**
* @var string
*/
public $plz;

/**
* @var string
*/
public $ort;

public function __construct() {
parent::__construct();
$this->model = new PlzModel();
}
public function save() {
$this->typeValueList->setModelValue($this->model->plz, $this->plz);
$this->typeValueList->setModelValue($this->model->ort, $this->ort);
$id = parent::save();
return $id;
}
}