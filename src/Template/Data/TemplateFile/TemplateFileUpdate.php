<?php
namespace Nemundo\Process\Template\Data\TemplateFile;
use Nemundo\Model\Data\AbstractModelUpdate;
class TemplateFileUpdate extends AbstractModelUpdate {
/**
* @var TemplateFileModel
*/
public $model;

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

/**
* @var string
*/
public $text;

public function __construct() {
parent::__construct();
$this->model = new TemplateFileModel();
$this->file = new \Nemundo\Model\Data\Property\File\RedirectFilenameDataProperty($this->model->file, $this->typeValueList);
}
public function update() {
$this->typeValueList->setModelValue($this->model->active, $this->active);
$this->typeValueList->setModelValue($this->model->contentId, $this->contentId);
$this->typeValueList->setModelValue($this->model->text, $this->text);
parent::update();
}
}