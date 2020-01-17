<?php
namespace Nemundo\Process\Template\Data\TemplateFileDelete;
use Nemundo\Model\Id\AbstractModelIdValue;
class TemplateFileDeleteId extends AbstractModelIdValue {
/**
* @var TemplateFileDeleteModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateFileDeleteModel();
}
}