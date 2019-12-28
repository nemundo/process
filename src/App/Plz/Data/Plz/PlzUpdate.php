<?php
namespace Nemundo\Process\App\Plz\Data\Plz;
use Nemundo\Model\Data\AbstractModelUpdate;
class PlzUpdate extends AbstractModelUpdate {
/**
* @var PlzModel
*/
public $model;

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
public function update() {
$this->typeValueList->setModelValue($this->model->plz, $this->plz);
$this->typeValueList->setModelValue($this->model->ort, $this->ort);
parent::update();
}
}