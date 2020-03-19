<?php
namespace Nemundo\Process\Template\Data\TemplateFile;
use Nemundo\Core\Debug\Debug;

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

/**
* @var string
*/
public $text;

public function __construct() {
parent::__construct();
$this->model = new TemplateFileModel();
    //(new Debug())->write($this->model->file->getDataPath());

$this->file = new \Nemundo\Model\Data\Property\File\RedirectFilenameDataProperty($this->model->file, $this->typeValueList);
    //(new Debug())->write($this->model->file->getDataPath());


}
public function save() {
$this->typeValueList->setModelValue($this->model->active, $this->active);
$this->typeValueList->setModelValue($this->model->contentId, $this->contentId);
$this->typeValueList->setModelValue($this->model->text, $this->text);
$id = parent::save();
return $id;
}
}