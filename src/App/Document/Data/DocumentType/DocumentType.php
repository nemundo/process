<?php
namespace Nemundo\Process\App\Document\Data\DocumentType;
class DocumentType extends \Nemundo\Model\Data\AbstractModelData {
/**
* @var DocumentTypeModel
*/
protected $model;

/**
* @var string
*/
public $contentTypeId;

public function __construct() {
parent::__construct();
$this->model = new DocumentTypeModel();
}
public function save() {
$this->typeValueList->setModelValue($this->model->contentTypeId, $this->contentTypeId);
$id = parent::save();
return $id;
}
}