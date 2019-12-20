<?php
namespace Nemundo\Process\Content\Data\Access;
class Access extends \Nemundo\Model\Data\AbstractModelData {
/**
* @var AccessModel
*/
protected $model;

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
public function save() {
$this->typeValueList->setModelValue($this->model->documentId, $this->documentId);
$property = new \Nemundo\Workflow\App\Identification\Model\IdentificationDataProperty($this->model->identification, $this->typeValueList);
$property->setValue($this->identification);
$id = parent::save();
return $id;
}
}