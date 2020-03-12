<?php


namespace Nemundo\Process\Template\Content\Comment;


use Nemundo\Core\Language\LanguageCode;
use Nemundo\Process\Template\Content\LargeText\AbstractLargeTextContentType;


class CommentContentType extends AbstractLargeTextContentType
{

    public $comment;


    protected function loadContentType()
    {

        $this->typeLabel[LanguageCode::EN] = 'Comment';
        $this->typeLabel[LanguageCode::DE] = 'Kommentar';
        $this->typeId = '63fa85d4-4c49-42cc-bd0d-af00a7d96458';

        $this->formClass = CommentForm::class;
        $this->viewClass = CommentView::class;

    }


    protected function onCreate()
    {

        $this->largeText = $this->comment;
        parent::onCreate();

    }


    protected function onIndex()
    {

        $row = $this->getDataRow();
        $this->addSearchText($row->largeText);

    }


    public function hasView()
    {
        return true;
    }

    public function getViewSite()
    {

        $parentContentType = $this->getParentContentType();
        return $parentContentType->getViewSite();

    }

}