<?php
namespace Nemundo\Process\Template\Data\TemplateWebFile;
class TemplateWebFileCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var TemplateWebFileModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateWebFileModel();
}
}