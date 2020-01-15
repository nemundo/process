<?php


namespace Nemundo\Process\Template\Content\File;


use Nemundo\Com\Html\Hyperlink\UrlHyperlink;
use Nemundo\Html\Block\Div;
use Nemundo\Process\Content\View\AbstractContentView;
use Nemundo\Process\Template\Data\TemplateFile\TemplateFileReader;


class FileContentView extends AbstractContentView
{

    public function getContent()
    {

        $fileRow = $this->contentType->getDataRow();

        $hyperlink = new UrlHyperlink($this);
        $hyperlink->content = $fileRow->file->getFilename();
        $hyperlink->url = $fileRow->file->getUrl();


        return parent::getContent();

    }

}