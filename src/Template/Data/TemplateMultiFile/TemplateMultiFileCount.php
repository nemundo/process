<?php
namespace Nemundo\Process\Template\Data\TemplateMultiFile;
class TemplateMultiFileCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var TemplateMultiFileModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateMultiFileModel();
}
}