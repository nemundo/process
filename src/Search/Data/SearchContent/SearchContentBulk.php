<?php
namespace Nemundo\Process\Search\Data\SearchContent;
class SearchContentBulk extends \Nemundo\Model\Data\AbstractModelDataBulk {
/**
* @var SearchContentModel
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

/**
* @var string
*/
public $text;

public function __construct() {
parent::__construct();
$this->model = new SearchContentModel();
}
public function save() {
$this->typeValueList->setModelValue($this->model->contentId, $this->contentId);
$this->typeValueList->setModelValue($this->model->title, $this->title);
$this->typeValueList->setModelValue($this->model->text, $this->text);
$id = parent::save();
return $id;
}
}