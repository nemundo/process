<?php
namespace Nemundo\Process\App\Document\Data\DocumentType;
class DocumentTypeValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var DocumentTypeModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new DocumentTypeModel();
}
}