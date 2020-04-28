<?php
namespace Nemundo\Process\Search\Data\SearchIndex;
class SearchIndexBulk extends \Nemundo\Model\Data\AbstractModelDataBulk {
/**
* @var SearchIndexModel
*/
protected $model;

/**
* @var string
*/
public $contentId;

/**
* @var string
*/
public $wordId;

/**
* @var string
*/
public $contentTypeId;

public function __construct() {
parent::__construct();
$this->model = new SearchIndexModel();
}
public function save() {
$this->typeValueList->setModelValue($this->model->contentId, $this->contentId);
$this->typeValueList->setModelValue($this->model->wordId, $this->wordId);
$this->typeValueList->setModelValue($this->model->contentTypeId, $this->contentTypeId);
$id = parent::save();
return $id;
}
}