<?php
namespace Nemundo\Process\Template\Data\TemplateMultiFile;
class TemplateMultiFileRow extends \Nemundo\Model\Row\AbstractModelDataRow {
/**
* @var \Nemundo\Model\Row\AbstractModelDataRow
*/
private $row;

/**
* @var TemplateMultiFileModel
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
* @var int
*/
public $dataContentId;

/**
* @var \Nemundo\Process\Content\Row\ContentCustomRow
*/
public $dataContent;

/**
* @var \Nemundo\Model\Reader\Property\File\RedirectFilenameReaderProperty
*/
public $file;

public function __construct(\Nemundo\Db\Row\AbstractDataRow $row, $model) {
parent::__construct($row->getData());
$this->row = $row;
$this->id = $this->getModelValue($model->id);
$this->active = boolval($this->getModelValue($model->active));
$this->dataContentId = intval($this->getModelValue($model->dataContentId));
if ($model->dataContent !== null) {
$this->loadNemundoProcessContentDataContentContentdataContentRow($model->dataContent);
}
$this->file = new \Nemundo\Model\Reader\Property\File\RedirectFilenameReaderProperty($row, $model->file, $model->id);
}
private function loadNemundoProcessContentDataContentContentdataContentRow($model) {
$this->dataContent = new \Nemundo\Process\Content\Row\ContentCustomRow($this->row, $model);
}
}