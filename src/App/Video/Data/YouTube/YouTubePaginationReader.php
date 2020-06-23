<?php
namespace Nemundo\Process\App\Video\Data\YouTube;
class YouTubePaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
/**
* @var YouTubeModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new YouTubeModel();
}
/**
* @return YouTubeRow[]
*/
public function getData() {
$list = [];
foreach (parent::getData() as $dataRow) {
$row = new YouTubeRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}