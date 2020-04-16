<?php
namespace Nemundo\Process\Template\Data\TemplateWebFile;
use Nemundo\Model\Data\AbstractModelUpdate;
class TemplateWebFileUpdate extends AbstractModelUpdate {
/**
* @var TemplateWebFileModel
*/
public $model;

/**
* @var \Nemundo\Model\Data\Property\File\FileDataProperty
*/
public $file;

public function __construct() {
parent::__construct();
$this->model = new TemplateWebFileModel();
$this->file = new \Nemundo\Model\Data\Property\File\FileDataProperty($this->model->file, $this->typeValueList);
}
public function update() {
parent::update();
}
}