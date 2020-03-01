<?php
namespace Nemundo\Process\App\Document\Data\DocumentType;
class DocumentTypeRow extends \Nemundo\Model\Row\AbstractModelDataRow {
/**
* @var \Nemundo\Model\Row\AbstractModelDataRow
*/
private $row;

/**
* @var DocumentTypeModel
*/
public $model;

/**
* @var string
*/
public $id;

/**
* @var string
*/
public $contentTypeId;

/**
* @var \Nemundo\Process\Content\Row\ContentTypeCustomRow
*/
public $contentType;

/**
* @var bool
*/
public $setupStatus;

public function __construct(\Nemundo\Db\Row\AbstractDataRow $row, $model) {
parent::__construct($row->getData());
$this->row = $row;
$this->id = $this->getModelValue($model->id);
$this->contentTypeId = $this->getModelValue($model->contentTypeId);
if ($model->contentType !== null) {
$this->loadNemundoProcessContentDataContentTypeContentTypecontentTypeRow($model->contentType);
}
$this->setupStatus = boolval($this->getModelValue($model->setupStatus));
}
private function loadNemundoProcessContentDataContentTypeContentTypecontentTypeRow($model) {
$this->contentType = new \Nemundo\Process\Content\Row\ContentTypeCustomRow($this->row, $model);
}
}