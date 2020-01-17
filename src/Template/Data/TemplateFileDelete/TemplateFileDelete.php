<?php
namespace Nemundo\Process\Template\Data\TemplateFileDelete;
class TemplateFileDelete extends \Nemundo\Model\Data\AbstractModelData {
/**
* @var TemplateFileDeleteModel
*/
protected $model;

/**
* @var string
*/
public $fileId;

public function __construct() {
parent::__construct();
$this->model = new TemplateFileDeleteModel();
}
public function save() {
$this->typeValueList->setModelValue($this->model->fileId, $this->fileId);
$id = parent::save();
return $id;
}
}