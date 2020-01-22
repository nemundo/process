<?php


namespace Nemundo\Process\Template\Content\File;


use Nemundo\Admin\Com\Table\AdminLabelValueTable;
use Nemundo\Admin\Com\Table\AdminTable;
use Nemundo\Com\Html\Hyperlink\UrlHyperlink;
use Nemundo\Core\File\FileInformation;

use Nemundo\Core\File\FileSize;
use Nemundo\Core\Type\File\File;
use Nemundo\Html\Block\Div;
use Nemundo\Package\Bootstrap\Image\BootstrapResponsiveImage;
use Nemundo\Process\Content\View\AbstractContentView;
use Nemundo\Process\Template\Data\TemplateFile\TemplateFileReader;


class FileContentView extends AbstractFileContentView
{

    /**
     * @var FileContentType
     */
    //public $contentType;

    public function getContent()
    {

        $fileRow = $this->contentType->getDataRow();

        $hyperlink = new UrlHyperlink($this);
        $hyperlink->content = $fileRow->file->getFilename();
        $hyperlink->url = $fileRow->file->getUrl();

        $fileSize = new FileSize($fileRow->file->getFileSize());

        $table = new AdminLabelValueTable($this);
        $table->addLabelValue('File Size', $fileRow->file->getFileSize());
        $table->addLabelValue('File Size',$fileSize->getText());
        $table->addLabelValue('Filename',$fileRow->file->getFullFilename());

        // isImage


        $fileInformation = new FileInformation($fileRow->file->getFullFilename());

        if ($fileInformation->isImage()) {

            $img = new BootstrapResponsiveImage($this);
            $img->src=$fileRow->file->getUrl();
            $img->width = 1200;

        }

        //$fileRow->file->getFileExtension()



        return parent::getContent();

    }

}