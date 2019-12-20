<?php
namespace Nemundo\Process\Content\Data\Document;
class DocumentValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var DocumentModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new DocumentModel();
}
}