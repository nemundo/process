<?php
namespace Nemundo\Process\Template\Data\TemplateMultiFile;
use Nemundo\Model\Id\AbstractModelIdValue;
class TemplateMultiFileId extends AbstractModelIdValue {
/**
* @var TemplateMultiFileModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateMultiFileModel();
}
}