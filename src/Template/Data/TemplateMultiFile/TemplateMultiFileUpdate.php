<?php
namespace Nemundo\Process\Template\Data\TemplateMultiFile;
use Nemundo\Model\Data\AbstractModelUpdate;
class TemplateMultiFileUpdate extends AbstractModelUpdate {
/**
* @var TemplateMultiFileModel
*/
public $model;

/**
* @var string
*/
public $dataContentId;

/**
* @var \Nemundo\Model\Data\Property\File\RedirectFilenameDataProperty
*/
public $file;

public function __construct() {
parent::__construct();
$this->model = new TemplateMultiFileModel();
$this->file = new \Nemundo\Model\Data\Property\File\RedirectFilenameDataProperty($this->model->file, $this->typeValueList);
}
public function update() {
$this->typeValueList->setModelValue($this->model->dataContentId, $this->dataContentId);
parent::update();
}
}