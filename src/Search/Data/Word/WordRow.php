<?php
namespace Nemundo\Process\Search\Data\Word;
class WordRow extends \Nemundo\Model\Row\AbstractModelDataRow {
/**
* @var \Nemundo\Model\Row\AbstractModelDataRow
*/
private $row;

/**
* @var WordModel
*/
public $model;

/**
* @var string
*/
public $id;

/**
* @var string
*/
public $word;

public function __construct(\Nemundo\Db\Row\AbstractDataRow $row, $model) {
parent::__construct($row->getData());
$this->row = $row;
$this->id = $this->getModelValue($model->id);
$this->word = $this->getModelValue($model->word);
}
}