<?php
namespace Nemundo\Process\App\Document\Data\Document;
class Document extends \Nemundo\Model\Data\AbstractModelData {
/**
* @var DocumentModel
*/
protected $model;

/**
* @var string
*/
public $contentId;

/**
* @var string
*/
public $title;

public function __construct() {
parent::__construct();
$this->model = new DocumentModel();
}
public function save() {
$this->typeValueList->setModelValue($this->model->contentId, $this->contentId);
$this->typeValueList->setModelValue($this->model->title, $this->title);
$id = parent::save();
return $id;
}
}