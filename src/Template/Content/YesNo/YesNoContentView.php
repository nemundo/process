<?php


namespace Nemundo\Process\Template\Content\YesNo;


use Nemundo\Package\FontAwesome\Icon\CheckIcon;
use Nemundo\Process\Content\View\AbstractContentView;

class YesNoContentView extends AbstractContentView
{
    /**
     * @var AbstractYesNoContentType
     */
    public $contentType;

    public function getContent()
    {

        $row = $this->contentType->getDataRow();
        if ($row->yesNo) {
            new CheckIcon($this);
        }

        return parent::getContent();

    }

}