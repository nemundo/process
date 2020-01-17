<?php
namespace Nemundo\Process\Template\Data\TemplateFileDelete;
class TemplateFileDeleteRow extends \Nemundo\Model\Row\AbstractModelDataRow {
/**
* @var \Nemundo\Model\Row\AbstractModelDataRow
*/
private $row;

/**
* @var TemplateFileDeleteModel
*/
public $model;

/**
* @var string
*/
public $id;

/**
* @var string
*/
public $fileId;

/**
* @var \Nemundo\Process\Template\Data\TemplateFile\TemplateFileRow
*/
public $file;

public function __construct(\Nemundo\Db\Row\AbstractDataRow $row, $model) {
parent::__construct($row->getData());
$this->row = $row;
$this->id = $this->getModelValue($model->id);
$this->fileId = $this->getModelValue($model->fileId);
if ($model->file !== null) {
$this->loadNemundoProcessTemplateDataTemplateFileTemplateFilefileRow($model->file);
}
}
private function loadNemundoProcessTemplateDataTemplateFileTemplateFilefileRow($model) {
$this->file = new \Nemundo\Process\Template\Data\TemplateFile\TemplateFileRow($this->row, $model);
}
}