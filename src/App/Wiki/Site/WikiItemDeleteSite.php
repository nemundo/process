<?php
namespace Nemundo\Process\App\Wiki\Site;
use Nemundo\Web\Site\AbstractSite;
class WikiItemDeleteSite extends AbstractSite {
protected function loadSite() {
$this->title = 'WikiItemDelete';
$this->url = 'wikiitemdelete';
}
public function loadContent() {
}
}