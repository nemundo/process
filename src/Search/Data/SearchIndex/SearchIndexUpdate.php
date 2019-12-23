<?php
namespace Nemundo\Process\Search\Data\SearchIndex;
use Nemundo\Model\Data\AbstractModelUpdate;
class SearchIndexUpdate extends AbstractModelUpdate {
/**
* @var SearchIndexModel
*/
public $model;

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
public function update() {
$this->typeValueList->setModelValue($this->model->contentId, $this->contentId);
$this->typeValueList->setModelValue($this->model->wordId, $this->wordId);
parent::update();
}
}