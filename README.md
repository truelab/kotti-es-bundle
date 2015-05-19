Truelab Kotti Es Bundle
===================================

A symfony2 bundle that provides simple elastic search integration for kotti-model @see [kotti-model-bundle](https://github.com/truelab/).

***This bundle is currently under development, the API must not be considered stable.***


## Install

Add this to yours ```composer.json```.

```js
{   // ...
    "require": {
        // ...
        "truelab/kotti-es-bundle": "dev-master",
        // ...
    },
    // ...
    "repositories" : [
        { "type":"git", "url":"https://github.com/truelab/kotti-es-bundle.git" }
    ]
}
```

Activate the bundle and dependent bundles to yours ```AppKernel.php```.

```php

<?php
# app/AppKernel.php

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // ...

            // REQUIRED dependent bundles
            new Truelab\KottiModelBundle\TruelabKottiModelBundle(), // model layer
            
            new Truelab\KottiEsBundle\TruelabKottiEsBundle(),
            
            // ...
        );
        
        // ...

        return $bundles;
    }
    
    // ...
}
```

## Configuration reference

```yml

truelab_kotti_es:
    host: localhost # default
    port: 9200 # default
    index: your_index_name # required
    alias_map: # required
        Document: document 
        # ...
    query_string_util: # defaults
        clean_query_text_pattern: '/([\"\<\>\^\?\*\~\.\!\(\)\+\-\=\:\{\}\/\\\])|(\|{2})|(&{2})/'
        escape_query_text_pattern: '/([\"\<\>\^\?\*\~\.\!\(\)\+\-\=\:\{\}\/\\\])|(\|{2})|(&{2})/'
        escape_query_text_replacement: '\\\\${1}${2}${3}'
```
