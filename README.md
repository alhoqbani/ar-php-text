<p align="center">
<a href="https://travis-ci.org/alhoqbani/ar-php-text"><img src="https://travis-ci.org/alhoqbani/ar-php-text.svg?branch=master" alt="Build Status"></a>
<a href="https://packagist.org/packages/alhoqbani/ar-php-text"><img src="https://poser.pugx.org/alhoqbani/ar-php-text/downloads" alt="Total Downloads"></a>
</p>


## Arabic Auto Summarize
### From http://ar-php.org/

#### Glyphs
To convert text to utf-8:
```
<?php
require_once 'vendor/autoload.php';

use Alhoqbani\ArPHP\Glyphs;
$glyphs = new Glyphs();
$text = "  ";
$text = $glyphs->utf8Glyphs($text);
```

### AutoSummarize


```

<?php
require_once 'vendor/autoload.php';

use Alhoqbani\ArPHP\AutoSummarize;

$auto_summarize = new ArabicAutoSummarize();
$summury = $auto_summarize->doRateSummarize($str,$rate,$keywords,$style);

```
