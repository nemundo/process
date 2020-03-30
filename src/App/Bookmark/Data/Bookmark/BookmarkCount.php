<?php
namespace Nemundo\Process\App\Bookmark\Data\Bookmark;
class BookmarkCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var BookmarkModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new BookmarkModel();
}
}