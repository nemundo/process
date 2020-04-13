<?php


namespace Nemundo\Process\Template\Content\FileList;


use Nemundo\Admin\Com\Table\AdminTable;
use Nemundo\Com\Html\Hyperlink\UrlHyperlink;
use Nemundo\Com\TableBuilder\TableRow;
use Nemundo\Process\Content\View\AbstractContentView;
use Nemundo\Process\Template\Content\File\AbstractFileContentType;
use Nemundo\Process\Template\Parameter\FileParameter;
use Nemundo\Process\Template\Site\FileInactiveSite;

class FileListContentView extends AbstractContentView
{

    /**
     * @var AbstractFileListContentType
     */
    public $contentType;


    public $showDeleteButton = false;

    public function getContent()
    {

        $table = new AdminTable($this);

        /*$header = new TableHeader($table);
        $header->addText('File');
        $header->addEmpty();*/

        // sortierung !!!

        foreach ($this->contentType->getChild() as $child) {

            /** @var AbstractFileContentType $contentType */
            $contentType = $child->getContentType();

            $row = new TableRow($table);
            //$row->addText($contentType->getSubject());


            $hyperlink = new UrlHyperlink($row);
            $hyperlink->content = $contentType->getDataRow()->file->getFilename();
            $hyperlink->url = $contentType->getDataRow()->file->getUrl();



            if ($this->showDeleteButton) {
                $site = clone(FileInactiveSite::$site);
                $site->addParameter(new FileParameter($child->dataId));
                $row->addIconSite($site);
            }

        }

        return parent::getContent();

    }

}