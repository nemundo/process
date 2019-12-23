<?php
namespace Nemundo\Process\Content\Data\ContentType;
class ContentTypeRow extends \Nemundo\Model\Row\AbstractModelDataRow {
/**
* @var \Nemundo\Model\Row\AbstractModelDataRow
*/
private $row;

/**
* @var ContentTypeModel
*/
public $model;

/**
* @var string
*/
public $id;

/**
* @var string
*/
public $phpClass;

/**
* @var string
*/
public $contentType;

public function __construct(\Nemundo\Db\Row\AbstractDataRow $row, $model) {
parent::__construct($row->getData());
$this->row = $row;
$this->id = $this->getModelValue($model->id);
$this->phpClass = $this->getModelValue($model->phpClass);
$this->contentType = $this->getModelValue($model->contentType);
}
}