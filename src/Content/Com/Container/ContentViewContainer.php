<?php


namespace Nemundo\Process\Content\Com\Container;


use Nemundo\Html\Block\Div;
use Nemundo\Html\Container\AbstractHtmlContainer;
use Nemundo\Process\Content\Type\AbstractTreeContentType;
use Nemundo\Process\Workflow\Content\Status\AbstractProcessStatus;

class ContentViewContainer extends AbstractHtmlContainer
{

    /**
     * @var AbstractTreeContentType
     */
    public $contentType;

    public function getContent()
    {

        foreach ($this->contentType->getChild() as $logRow) {

            /** @var AbstractProcessStatus $status */
            $status = $logRow->getContentType();

            if ($status->hasView()) {

                $div = new Div($this);
                if ($status->hasView()) {
                    $view = $status->getView($div);
                    $view->dataId = $logRow->dataId;
                }

            }

        }

        return parent::getContent();

    }

}