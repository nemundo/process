<?php
namespace Nemundo\Process\App\Document\Data\DocumentType;
use Nemundo\Model\Data\AbstractModelUpdate;
class DocumentTypeUpdate extends AbstractModelUpdate {
/**
* @var DocumentTypeModel
*/
public $model;

/**
* @var string
*/
public $contentTypeId;

public function __construct() {
parent::__construct();
$this->model = new DocumentTypeModel();
}
public function update() {
$this->typeValueList->setModelValue($this->model->contentTypeId, $this->contentTypeId);
parent::update();
}
}