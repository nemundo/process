<?php


namespace Nemundo\Process\Template\Content\File;


use Nemundo\Admin\Com\Table\AdminLabelValueTable;
use Nemundo\Com\Html\Hyperlink\UrlHyperlink;
use Nemundo\Core\File\FileInformation;
use Nemundo\Core\File\FileSize;
use Nemundo\Package\Bootstrap\FormElement\BootstrapLargeTextBox;
use Nemundo\Package\Bootstrap\Image\BootstrapResponsiveImage;


class FileContentView extends AbstractFileContentView
{

    public function getContent()
    {

        $fileRow = $this->contentType->getDataRow();

        $hyperlink = new UrlHyperlink($this);
        $hyperlink->content = $fileRow->file->getFilename();
        $hyperlink->url = $fileRow->file->getUrl();

        $fileSize = new FileSize($fileRow->file->getFileSize());

        $table = new AdminLabelValueTable($this);

        if (!$fileRow->active) {
            $table->addLabelValue('Status', 'File is deleted');
        }

        $table->addLabelValue('File Size', $fileRow->file->getFileSize());
        $table->addLabelValue('File Size', $fileSize->getText());
        $table->addLabelValue('Filename', $fileRow->file->getFullFilename());
        $table->addLabelValue('Filename Extension', $fileRow->file->getFileExtension());

        // isImage


        $fileInformation = new FileInformation($fileRow->file->getFullFilename());

        if ($fileInformation->isImage()) {

            $img = new BootstrapResponsiveImage($this);
            $img->src = $fileRow->file->getUrl();
            $img->width = 1200;

        }


        if ($fileInformation->isPdf()) {

            $textBox = new BootstrapLargeTextBox($this);
            $textBox->value = $fileRow->text;


        }

        return parent::getContent();

    }

}