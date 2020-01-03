<?php
namespace Nemundo\Process\Search\Data\SearchIndex;
class SearchIndexRow extends \Nemundo\Model\Row\AbstractModelDataRow {
/**
* @var \Nemundo\Model\Row\AbstractModelDataRow
*/
private $row;

/**
* @var SearchIndexModel
*/
public $model;

/**
* @var string
*/
public $id;

/**
* @var string
*/
public $contentId;

/**
* @var \Nemundo\Process\Content\Row\ContentCustomRow
*/
public $content;

/**
* @var string
*/
public $wordId;

/**
* @var \Nemundo\Process\Search\Data\Word\WordRow
*/
public $word;

public function __construct(\Nemundo\Db\Row\AbstractDataRow $row, $model) {
parent::__construct($row->getData());
$this->row = $row;
$this->id = $this->getModelValue($model->id);
$this->contentId = $this->getModelValue($model->contentId);
if ($model->content !== null) {
$this->loadNemundoProcessContentDataContentContentcontentRow($model->content);
}
$this->wordId = $this->getModelValue($model->wordId);
if ($model->word !== null) {
$this->loadNemundoProcessSearchDataWordWordwordRow($model->word);
}
}
private function loadNemundoProcessContentDataContentContentcontentRow($model) {
$this->content = new \Nemundo\Process\Content\Row\ContentCustomRow($this->row, $model);
}
private function loadNemundoProcessSearchDataWordWordwordRow($model) {
$this->word = new \Nemundo\Process\Search\Data\Word\WordRow($this->row, $model);
}
}