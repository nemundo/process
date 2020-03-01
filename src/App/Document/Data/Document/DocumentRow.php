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
* @var int
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
* @var bool
*/
public $closed;

/**
* @var string
*/
public $documentTypeId;

/**
* @var \Nemundo\Process\Content\Row\ContentTypeCustomRow
*/
public $documentType;

public function __construct(\Nemundo\Db\Row\AbstractDataRow $row, $model) {
parent::__construct($row->getData());
$this->row = $row;
$this->id = $this->getModelValue($model->id);
$this->contentId = intval($this->getModelValue($model->contentId));
if ($model->content !== null) {
$this->loadNemundoProcessContentDataContentContentcontentRow($model->content);
}
$this->title = $this->getModelValue($model->title);
$this->closed = boolval($this->getModelValue($model->closed));
$this->documentTypeId = $this->getModelValue($model->documentTypeId);
if ($model->documentType !== null) {
$this->loadNemundoProcessContentDataContentTypeContentTypedocumentTypeRow($model->documentType);
}
}
private function loadNemundoProcessContentDataContentContentcontentRow($model) {
$this->content = new \Nemundo\Process\Content\Row\ContentCustomRow($this->row, $model);
}
private function loadNemundoProcessContentDataContentTypeContentTypedocumentTypeRow($model) {
$this->documentType = new \Nemundo\Process\Content\Row\ContentTypeCustomRow($this->row, $model);
}
}