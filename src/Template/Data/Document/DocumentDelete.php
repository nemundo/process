<?php
namespace Nemundo\Process\Template\Data\Document;
class DocumentDelete extends \Nemundo\Model\Delete\AbstractModelDelete {
/**
* @var DocumentModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new DocumentModel();
}
}