<?php
namespace Nemundo\Process\Content\Data\Content;
class ContentRow extends \Nemundo\Model\Row\AbstractModelDataRow {
/**
* @var \Nemundo\Model\Row\AbstractModelDataRow
*/
private $row;

/**
* @var ContentModel
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
* @var string
*/
public $dataId;

/**
* @var \Nemundo\Core\Type\DateTime\DateTime
*/
public $dateTimeCreated;

/**
* @var string
*/
public $parentId;

/**
* @var int
*/
public $itemOrder;

/**
* @var string
*/
public $userCreatedId;

/**
* @var \Nemundo\User\Data\User\UserRow
*/
public $userCreated;

public function __construct(\Nemundo\Db\Row\AbstractDataRow $row, $model) {
parent::__construct($row->getData());
$this->row = $row;
$this->id = $this->getModelValue($model->id);
$this->contentTypeId = $this->getModelValue($model->contentTypeId);
if ($model->contentType !== null) {
$this->loadNemundoProcessContentDataContentTypeContentTypecontentTypeRow($model->contentType);
}
$this->dataId = $this->getModelValue($model->dataId);
$this->dateTimeCreated = new \Nemundo\Core\Type\DateTime\DateTime($this->getModelValue($model->dateTimeCreated));
$this->parentId = $this->getModelValue($model->parentId);
$this->itemOrder = intval($this->getModelValue($model->itemOrder));
$this->userCreatedId = $this->getModelValue($model->userCreatedId);
if ($model->userCreated !== null) {
$this->loadNemundoUserDataUserUseruserCreatedRow($model->userCreated);
}
}
private function loadNemundoProcessContentDataContentTypeContentTypecontentTypeRow($model) {
$this->contentType = new \Nemundo\Process\Content\Row\ContentTypeCustomRow($this->row, $model);
}
private function loadNemundoUserDataUserUseruserCreatedRow($model) {
$this->userCreated = new \Nemundo\User\Data\User\UserRow($this->row, $model);
}
}