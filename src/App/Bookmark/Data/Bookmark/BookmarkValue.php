<?php
namespace Nemundo\Process\App\Bookmark\Data\Bookmark;
class BookmarkValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var BookmarkModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new BookmarkModel();
}
}