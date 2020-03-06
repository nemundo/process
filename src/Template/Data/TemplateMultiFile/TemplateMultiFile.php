<?php
namespace Nemundo\Process\Template\Data\TemplateMultiFile;
class TemplateMultiFile extends \Nemundo\Model\Data\AbstractModelData {
/**
* @var TemplateMultiFileModel
*/
protected $model;

/**
* @var bool
*/
public $active;

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
public function save() {
$this->typeValueList->setModelValue($this->model->active, $this->active);
$this->typeValueList->setModelValue($this->model->dataContentId, $this->dataContentId);
$id = parent::save();
return $id;
}
}