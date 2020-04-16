<?php
namespace Nemundo\Process\Template\Data\TemplateMultiFile\Redirect;
class TemplateMultiFileFileRedirectSite extends \Nemundo\Model\Redirect\AbstractRedirectFilenameSite {
public function loadSite() {
parent::loadSite();
$this->url = "process-template-multi-file-file-redirect";
$this->model = new  \Nemundo\Process\Template\Data\TemplateMultiFile\TemplateMultiFileModel();
$this->type = $this->model->file;
TemplateMultiFileRedirectConfig::$redirectTemplateMultiFileFileSite = $this;
}
}