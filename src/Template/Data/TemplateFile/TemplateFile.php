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

/**
* @var string
*/
public $contentId;

public function __construct() {
parent::__construct();
$this->model = new TemplateFileModel();
$this->file = new \Nemundo\Model\Data\Property\File\RedirectFilenameDataProperty($this->model->file, $this->typeValueList);
}
public function save() {
$this->typeValueList->setModelValue($this->model->active, $this->active);
$this->typeValueList->setModelValue($this->model->contentId, $this->contentId);
$id = parent::save();
return $id;
}
}