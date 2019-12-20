<?php
namespace Nemundo\Process\Content\Data\Access;
use Nemundo\Model\Data\AbstractModelUpdate;
class AccessUpdate extends AbstractModelUpdate {
/**
* @var AccessModel
*/
public $model;

/**
* @var string
*/
public $documentId;

/**
* @var \Nemundo\Workflow\App\Identification\Model\Identification
*/
public $identification;

public function __construct() {
parent::__construct();
$this->model = new AccessModel();
$this->identification = new \Nemundo\Workflow\App\Identification\Model\Identification();
}
public function update() {
$this->typeValueList->setModelValue($this->model->documentId, $this->documentId);
$property = new \Nemundo\Workflow\App\Identification\Model\IdentificationDataProperty($this->model->identification, $this->typeValueList);
$property->setValue($this->identification);
parent::update();
}
}