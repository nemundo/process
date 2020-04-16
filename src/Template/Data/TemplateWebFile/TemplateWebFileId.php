<?php
namespace Nemundo\Process\Template\Data\TemplateWebFile;
use Nemundo\Model\Id\AbstractModelIdValue;
class TemplateWebFileId extends AbstractModelIdValue {
/**
* @var TemplateWebFileModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateWebFileModel();
}
}