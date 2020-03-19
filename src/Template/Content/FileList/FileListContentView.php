<?php


namespace Nemundo\Process\Template\Content\FileList;


use Nemundo\Admin\Com\Table\AdminTable;
use Nemundo\Com\TableBuilder\TableRow;
use Nemundo\Process\Content\View\AbstractContentView;
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

        foreach ($this->contentType->getChild() as $child) {

            $contentType = $child->getContentType();

            $row = new TableRow($table);
            $row->addText($contentType->getSubject());

            if ($this->showDeleteButton) {
                $site = clone(FileInactiveSite::$site);
                $site->addParameter(new FileParameter($child->dataId));
                $row->addIconSite($site);
            }

        }

        return parent::getContent();

    }

}