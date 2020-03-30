<?php
namespace Nemundo\Process\App\Bookmark\Data\Bookmark;
class BookmarkDelete extends \Nemundo\Model\Delete\AbstractModelDelete {
/**
* @var BookmarkModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new BookmarkModel();
}
}