<?php
namespace Nemundo\Process\Search\Data\SearchContent;
use Nemundo\Model\Data\AbstractModelUpdate;
class SearchContentUpdate extends AbstractModelUpdate {
/**
* @var SearchContentModel
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

public function __construct() {
parent::__construct();
$this->model = new SearchContentModel();
}
public function update() {
$this->typeValueList->setModelValue($this->model->contentId, $this->contentId);
$this->typeValueList->setModelValue($this->model->title, $this->title);
$this->typeValueList->setModelValue($this->model->text, $this->text);
parent::update();
}
}