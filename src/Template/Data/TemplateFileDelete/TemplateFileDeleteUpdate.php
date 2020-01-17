<?php
namespace Nemundo\Process\Template\Data\TemplateFileDelete;
use Nemundo\Model\Data\AbstractModelUpdate;
class TemplateFileDeleteUpdate extends AbstractModelUpdate {
/**
* @var TemplateFileDeleteModel
*/
public $model;

/**
* @var string
*/
public $fileId;

public function __construct() {
parent::__construct();
$this->model = new TemplateFileDeleteModel();
}
public function update() {
$this->typeValueList->setModelValue($this->model->fileId, $this->fileId);
parent::update();
}
}