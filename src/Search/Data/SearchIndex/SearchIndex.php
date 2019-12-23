<?php
namespace Nemundo\Process\Search\Data\SearchIndex;
class SearchIndex extends \Nemundo\Model\Data\AbstractModelData {
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

public function __construct() {
parent::__construct();
$this->model = new SearchIndexModel();
}
public function save() {
$this->typeValueList->setModelValue($this->model->contentId, $this->contentId);
$this->typeValueList->setModelValue($this->model->wordId, $this->wordId);
$id = parent::save();
return $id;
}
}