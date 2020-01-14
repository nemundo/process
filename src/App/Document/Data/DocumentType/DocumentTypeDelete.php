<?php
namespace Nemundo\Process\App\Document\Data\DocumentType;
class DocumentTypeDelete extends \Nemundo\Model\Delete\AbstractModelDelete {
/**
* @var DocumentTypeModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new DocumentTypeModel();
}
}