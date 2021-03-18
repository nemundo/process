<?php
namespace Nemundo\Process\App\Bookmark\Data\Bookmark;
class BookmarkBulk extends \Nemundo\Model\Data\AbstractModelDataBulk {
/**
* @var BookmarkModel
*/
protected $model;

/**
* @var string
*/
public $url;

/**
* @var string
*/
public $title;

/**
* @var string
*/
public $description;

public function __construct() {
parent::__construct();
$this->model = new BookmarkModel();
}
public function save() {
$this->typeValueList->setModelValue($this->model->url, $this->url);
$this->typeValueList->setModelValue($this->model->title, $this->title);
$this->typeValueList->setModelValue($this->model->description, $this->description);
$id = parent::save();
return $id;
}
}