<?php
namespace Nemundo\Process\App\Document\Data\DocumentType;
class DocumentTypeCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var DocumentTypeModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new DocumentTypeModel();
}
}