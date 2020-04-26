<?php

namespace Nemundo\Process\Search\Site\Json;


use Nemundo\Package\Bootstrap\Autocomplete\AbstractAutocompleteJsonSite;
use Nemundo\Package\Bootstrap\Autocomplete\AutocompleteParameter;
use Nemundo\Process\Content\Parameter\ContentTypeParameter;
use Nemundo\Process\Search\Data\WordContentType\WordContentTypeReader;


class SearchContentTypeJsonSite extends AbstractAutocompleteJsonSite
{

    /**
     * @var SearchContentTypeJsonSite
     */
    public static $site;


    protected function loadSite()
    {
        $this->title='Search Json';
        $this->url = 'search-content-type-json';
        SearchContentTypeJsonSite::$site = $this;
    }


    protected function loadAutocompleteJson()
    {

        $wordReader = new WordContentTypeReader();
        $wordReader->filter->andEqual($wordReader->model->contentTypeId, (new ContentTypeParameter())->getValue());
        $wordReader->filter->andContainsLeft($wordReader->model->word, (new AutocompleteParameter())->getValue());
        $wordReader->addOrder($wordReader->model->word);
        $wordReader->limit = 20;
        foreach ($wordReader->getData() as $wordRow) {
            $this->addWord($wordRow->word);
        }


    }

}