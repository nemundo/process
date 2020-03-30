<?php


namespace Nemundo\Process\App\Podcast\Content\Episode;



use Nemundo\Process\Content\Type\AbstractTreeContentType;

class EpisodeContentType extends AbstractTreeContentType
{

    protected function loadContentType()
    {

        $this->typeLabel = 'Episode';
        $this->typeId='7c727c6f-e179-442d-acf6-e5f7c602d1ee';

        $this->viewClass=EpisodeContentView::class;

    }

    protected function onCreate()
    {



    }

}