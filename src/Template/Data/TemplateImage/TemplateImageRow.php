<?php
namespace Nemundo\Process\Template\Data\TemplateImage;
class TemplateImageRow extends \Nemundo\Model\Row\AbstractModelDataRow {
/**
* @var \Nemundo\Model\Row\AbstractModelDataRow
*/
private $row;

/**
* @var TemplateImageModel
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

public function __construct(\Nemundo\Db\Row\AbstractDataRow $row, $model) {
parent::__construct($row->getData());
$this->row = $row;
$this->id = $this->getModelValue($model->id);
$this->active = boolval($this->getModelValue($model->active));
$this->image = new \Nemundo\Model\Reader\Property\File\ImageReaderProperty($row, $model->image);
}
}