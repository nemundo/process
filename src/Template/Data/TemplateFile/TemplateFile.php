<?php
namespace Nemundo\Process\Template\Data\TemplateFile;
class TemplateFile extends \Nemundo\Model\Data\AbstractModelData {
/**
* @var TemplateFileModel
*/
protected $model;

/**
* @var bool
*/
public $active;

/**
* @var \Nemundo\Model\Data\Property\File\RedirectFilenameDataProperty
*/
public $file;

public function __construct() {
parent::__construct();
$this->model = new TemplateFileModel();
$this->file = new \Nemundo\Model\Data\Property\File\RedirectFilenameDataProperty($this->model->file, $this->typeValueList);
}
public function save() {
$this->typeValueList->setModelValue($this->model->active, $this->active);
$id = parent::save();
return $id;
}
}