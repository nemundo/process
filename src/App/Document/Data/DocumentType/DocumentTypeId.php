<?php
namespace Nemundo\Process\App\Document\Data\DocumentType;
use Nemundo\Model\Id\AbstractModelIdValue;
class DocumentTypeId extends AbstractModelIdValue {
/**
* @var DocumentTypeModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new DocumentTypeModel();
}
}