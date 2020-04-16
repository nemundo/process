<?php
namespace Nemundo\Process\Template\Data\TemplateWebFile;
class TemplateWebFileBulk extends \Nemundo\Model\Data\AbstractModelDataBulk {
/**
* @var TemplateWebFileModel
*/
protected $model;

/**
* @var \Nemundo\Model\Data\Property\File\FileDataProperty
*/
public $file;

public function __construct() {
parent::__construct();
$this->model = new TemplateWebFileModel();
$this->file = new \Nemundo\Model\Data\Property\File\FileDataProperty($this->model->file, $this->typeValueList);
}
public function save() {
$id = parent::save();
return $id;
}
}