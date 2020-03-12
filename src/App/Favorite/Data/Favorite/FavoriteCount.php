<?php
namespace Nemundo\Process\App\Favorite\Data\Favorite;
class FavoriteCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var FavoriteModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new FavoriteModel();
}
}