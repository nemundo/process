<?php
namespace Nemundo\Process\Template\Data\TemplateMultiImage;
class TemplateMultiImageRow extends \Nemundo\Model\Row\AbstractModelDataRow {
/**
* @var \Nemundo\Model\Row\AbstractModelDataRow
*/
private $row;

/**
* @var TemplateMultiImageModel
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
* @var \Nemundo\Model\Reader\Property\File\ImageReaderProperty
*/
public $image;

/**
* @var int
*/
public $dataContentId;

/**
* @var \Nemundo\Process\Content\Row\ContentCustomRow
*/
public $dataContent;

public function __construct(\Nemundo\Db\Row\AbstractDataRow $row, $model) {
parent::__construct($row->getData());
$this->row = $row;
$this->id = $this->getModelValue($model->id);
$this->active = boolval($this->getModelValue($model->active));
$this->image = new \Nemundo\Model\Reader\Property\File\ImageReaderProperty($row, $model->image);
$this->dataContentId = intval($this->getModelValue($model->dataContentId));
if ($model->dataContent !== null) {
$this->loadNemundoProcessContentDataContentContentdataContentRow($model->dataContent);
}
}
private function loadNemundoProcessContentDataContentContentdataContentRow($model) {
$this->dataContent = new \Nemundo\Process\Content\Row\ContentCustomRow($this->row, $model);
}
}