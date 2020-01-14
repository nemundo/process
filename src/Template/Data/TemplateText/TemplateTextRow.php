<?php
namespace Nemundo\Process\Template\Data\TemplateText;
class TemplateTextRow extends \Nemundo\Model\Row\AbstractModelDataRow {
/**
* @var \Nemundo\Model\Row\AbstractModelDataRow
*/
private $row;

/**
* @var TemplateTextModel
*/
public $model;

/**
* @var string
*/
public $id;

/**
* @var string
*/
public $text;

public function __construct(\Nemundo\Db\Row\AbstractDataRow $row, $model) {
parent::__construct($row->getData());
$this->row = $row;
$this->id = $this->getModelValue($model->id);
$this->text = $this->getModelValue($model->text);
}
}