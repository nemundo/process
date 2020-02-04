<?php
namespace Nemundo\Process\App\Document\Data\Document;
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
public $contentId;

/**
* @var \Nemundo\Process\Content\Row\ContentCustomRow
*/
public $content;

/**
* @var string
*/
public $title;

/**
* @var string
*/
public $text;

/**
* @var string
*/
public $sourceId;

/**
* @var \Nemundo\Process\Content\Row\ContentCustomRow
*/
public $source;

public function __construct(\Nemundo\Db\Row\AbstractDataRow $row, $model) {
parent::__construct($row->getData());
$this->row = $row;
$this->id = $this->getModelValue($model->id);
$this->contentId = $this->getModelValue($model->contentId);
if ($model->content !== null) {
$this->loadNemundoProcessContentDataContentContentcontentRow($model->content);
}
$this->title = $this->getModelValue($model->title);
$this->text = $this->getModelValue($model->text);
$this->sourceId = $this->getModelValue($model->sourceId);
if ($model->source !== null) {
$this->loadNemundoProcessContentDataContentContentsourceRow($model->source);
}
}
private function loadNemundoProcessContentDataContentContentcontentRow($model) {
$this->content = new \Nemundo\Process\Content\Row\ContentCustomRow($this->row, $model);
}
private function loadNemundoProcessContentDataContentContentsourceRow($model) {
$this->source = new \Nemundo\Process\Content\Row\ContentCustomRow($this->row, $model);
}
}