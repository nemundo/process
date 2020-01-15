<?php
namespace Nemundo\Process\Template\Data\TemplateFile;
use Nemundo\Model\Id\AbstractModelIdValue;
class TemplateFileId extends AbstractModelIdValue {
/**
* @var TemplateFileModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateFileModel();
}
}