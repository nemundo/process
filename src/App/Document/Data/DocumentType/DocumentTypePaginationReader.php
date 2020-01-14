<?php
namespace Nemundo\Process\App\Document\Data\DocumentType;
class DocumentTypePaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
/**
* @var DocumentTypeModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new DocumentTypeModel();
}
/**
* @return DocumentTypeRow[]
*/
public function getData() {
$list = [];
foreach (parent::getData() as $dataRow) {
$row = new DocumentTypeRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}