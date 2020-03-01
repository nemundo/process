<?php
namespace Nemundo\Process\App\Document\Data\DocumentType;
class DocumentTypeBulk extends \Nemundo\Model\Data\AbstractModelDataBulk {
/**
* @var DocumentTypeModel
*/
protected $model;

/**
* @var string
*/
public $contentTypeId;

/**
* @var bool
*/
public $setupStatus;

public function __construct() {
parent::__construct();
$this->model = new DocumentTypeModel();
}
public function save() {
$this->typeValueList->setModelValue($this->model->contentTypeId, $this->contentTypeId);
$this->typeValueList->setModelValue($this->model->setupStatus, $this->setupStatus);
$id = parent::save();
return $id;
}
}