<?php
namespace Nemundo\Process\Template\Data\Youtube;
class YoutubePaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
/**
* @var YoutubeModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new YoutubeModel();
}
/**
* @return YoutubeRow[]
*/
public function getData() {
$list = [];
foreach (parent::getData() as $dataRow) {
$row = new YoutubeRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}