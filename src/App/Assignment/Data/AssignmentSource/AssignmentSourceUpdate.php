<?php
namespace Nemundo\Process\App\Assignment\Data\AssignmentSource;
use Nemundo\Model\Data\AbstractModelUpdate;
class AssignmentSourceUpdate extends AbstractModelUpdate {
/**
* @var AssignmentSourceModel
*/
public $model;

/**
* @var string
*/
public $sourceId;

public function __construct() {
parent::__construct();
$this->model = new AssignmentSourceModel();
}
public function update() {
$this->typeValueList->setModelValue($this->model->sourceId, $this->sourceId);
parent::update();
}
}