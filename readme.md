#The Libs
PHP Configuration reader in several format  like https://github.com/symfony/Config but Fitness :D
Now it reads configuration file on YML, JSON, and INI format

##Usage
add to composer require *"ashrey/pantaconf": "dev-master"*
and your PHP code:

```php
<?php
$conf = new Ashrey\Config\Config();
$var = $conf->read('config.yml');
var_dump($var);
```

if you want using cache
```php
<?php
$conf = new Ashrey\Config\Config('./cache');
$var = $conf->read('config.yml');
var_dump($var);
```

##License
Copyright (c) 2014 Alberto Berroteran

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.

##To Do
- Create cache
- Add XML parser
- Validate paths

##Donations
If you found this libs useful,
you can make me  Bitcoin donations at 1F55McMcJzVVr7JqBwb4oawsUR3R6KQQJY