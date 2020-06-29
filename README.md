# Process Framework


## Installation 
```
composer require nemundo/process
```




## Dev Installation 
```
git submodule add https://github.com/nemundo/process.git lib/process
```

```
$lib = new Library($autoload);
$lib->source = __DIR__ . '/lib/process/src/';
$lib->namespace = 'Nemundo\\Process';
```




### Content Check
Delete Invalid Content Item
```
php bin/cmd.php content-check
```


### Search ReIndexing
```
php bin/cmd.php index-reindex
```

### Clean Search Word
```
php bin/cmd.php search-word-clean
```

