<?php
namespace Nemundo\Process\Content\Data\Document;
class DocumentRow extends \Nemundo\Model\Row\AbstractModelDataRow {
/**
* @var \Nemundo\Model\Row\AbstractModelDataRow
*/
private $row;

/**
* @var DocumentModel
*/
public $model;

/**
* @var string
*/
public $id;

/**
* @var string
*/
public $dataId;

/**
* @var string
*/
public $subject;

/**
* @var string
*/
public $text;

public function __construct(\Nemundo\Db\Row\AbstractDataRow $row, $model) {
parent::__construct($row->getData());
$this->row = $row;
$this->id = $this->getModelValue($model->id);
$this->dataId = $this->getModelValue($model->dataId);
$this->subject = $this->getModelValue($model->subject);
$this->text = $this->getModelValue($model->text);
}
}