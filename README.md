# yii2-less-asset
Yii2 AssetBundle with lessc

Installation
============

Installation with **composer**.

> This instructions assumes that you have **composer** installed.

Download using composer
-------------------------------

Add **yii2-less-asset** to the require section of your **composer.json** file:

```js
{
    "require": {
        "radfuse/yii2-less-asset": "dev-master"
    }
}
```

And run following command to download extension using **composer**:

```bash
$ php composer.phar update
```

OR

```bash
$ php composer.phar require radfuse/yii2-less-asset "dev-master"
```

Usage:
--------

Simply extend your asset from LessAsset, then add your less files list to the $less variable.


```php
...
use radfuse\less\LessAsset;
...

class AppAsset extends LessAsset
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $less = [
        'main'
    ];
}
...
```

Configuration
=============

LessAsset extends the base AssetBundle, so you can define the basic parameters (like $basePath). Also you can override some less-specific params:

- sourceFolder:
	- path of the less files under $basePath
	- default: `less`
- destinationFolder:
	- path of the destination css files under $basePath
	- default: `css`

The default values for these params will read the @webroot/less/\*.less files and convert them to @webroot/css/\*.css files.