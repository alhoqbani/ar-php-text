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
``````
```
<?php
require_once 'vendor/autoload.php';

use Alhoqbani\ArPHP\AutoSummarize;

$auto_summarize = new ArabicAutoSummarize();
$summury = $auto_summarize->doRateSummarize($str,$rate,$keywords,$style);
```