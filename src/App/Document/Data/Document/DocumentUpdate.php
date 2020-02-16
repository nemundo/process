<?php
namespace Nemundo\Process\App\Document\Data\Document;
use Nemundo\Model\Data\AbstractModelUpdate;
class DocumentUpdate extends AbstractModelUpdate {
/**
* @var DocumentModel
*/
public $model;

/**
* @var string
*/
public $contentId;

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

public function __construct() {
parent::__construct();
$this->model = new DocumentModel();
}
public function update() {
$this->typeValueList->setModelValue($this->model->contentId, $this->contentId);
$this->typeValueList->setModelValue($this->model->title, $this->title);
$this->typeValueList->setModelValue($this->model->text, $this->text);
$this->typeValueList->setModelValue($this->model->sourceId, $this->sourceId);
parent::update();
}
}