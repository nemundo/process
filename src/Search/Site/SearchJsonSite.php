<?php

namespace Nemundo\Process\Search\Site;


use Nemundo\Package\Bootstrap\Autocomplete\AbstractAutocompleteJsonSite;
use Nemundo\Package\Bootstrap\Autocomplete\AutocompleteParameter;
use Nemundo\Process\Search\Data\Word\WordReader;


class SearchJsonSite extends AbstractAutocompleteJsonSite
{


    /**
     * @var SearchJsonSite
     */
    public static $site;


    protected function loadSite()
    {
        $this->url = 'search-json';
        SearchJsonSite::$site = $this;
    }


    protected function loadAutocompleteJson()
    {

        $wordReader = new WordReader();
        $wordReader->filter->andContainsLeft($wordReader->model->word, (new AutocompleteParameter())->getValue());
        $wordReader->addOrder($wordReader->model->word);
        $wordReader->limit = 20;
        foreach ($wordReader->getData() as $wordRow) {
            $this->addWord($wordRow->word);
        }


    }

}