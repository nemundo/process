<?php
namespace Nemundo\Process\Content\Data\Content;
use Nemundo\Model\Data\AbstractModelUpdate;
class ContentUpdate extends AbstractModelUpdate {
/**
* @var ContentModel
*/
public $model;

/**
* @var string
*/
public $contentTypeId;

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

public function __construct() {
parent::__construct();
$this->model = new ContentModel();
$this->dateTimeCreated = new \Nemundo\Core\Type\DateTime\DateTime();
}
public function update() {
$this->typeValueList->setModelValue($this->model->contentTypeId, $this->contentTypeId);
$this->typeValueList->setModelValue($this->model->dataId, $this->dataId);
$property = new \Nemundo\Model\Data\Property\DateTime\DateTimeDataProperty($this->model->dateTimeCreated, $this->typeValueList);
$property->setValue($this->dateTimeCreated);
$this->typeValueList->setModelValue($this->model->parentId, $this->parentId);
$this->typeValueList->setModelValue($this->model->itemOrder, $this->itemOrder);
$this->typeValueList->setModelValue($this->model->userCreatedId, $this->userCreatedId);
parent::update();
}
}