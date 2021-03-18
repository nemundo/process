<?php
namespace Nemundo\Process\App\Bookmark\Data\Bookmark;
use Nemundo\Model\Id\AbstractModelIdValue;
class BookmarkId extends AbstractModelIdValue {
/**
* @var BookmarkModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new BookmarkModel();
}
}