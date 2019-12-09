<?php
namespace Nemundo\Process\Template\Data\Document;
use Nemundo\Model\Id\AbstractModelIdValue;
class DocumentId extends AbstractModelIdValue {
/**
* @var DocumentModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new DocumentModel();
}
}