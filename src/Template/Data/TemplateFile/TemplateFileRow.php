<?php
namespace Nemundo\Process\Template\Data\TemplateFile;
class TemplateFileRow extends \Nemundo\Model\Row\AbstractModelDataRow {
/**
* @var \Nemundo\Model\Row\AbstractModelDataRow
*/
private $row;

/**
* @var TemplateFileModel
*/
public $model;

/**
* @var string
*/
public $id;

/**
* @var bool
*/
public $active;

/**
* @var \Nemundo\Model\Reader\Property\File\RedirectFilenameReaderProperty
*/
public $file;

public function __construct(\Nemundo\Db\Row\AbstractDataRow $row, $model) {
parent::__construct($row->getData());
$this->row = $row;
$this->id = $this->getModelValue($model->id);
$this->active = boolval($this->getModelValue($model->active));
$this->file = new \Nemundo\Model\Reader\Property\File\RedirectFilenameReaderProperty($row, $model->file, $this->id);
}
}