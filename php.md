# Command line application template for PHP

Implement CLI application by editing [Main.php](app/Main.php).  
You may add new files to keep your code clean, if it is allowed in your challenge.

## How to get input parameters
You can get commandline arguments as `$argv` and also can get count of the `$argv` by `$args` in [Main.php](app/Main.php) file where `run` method is defined.

```php
<?php

function run ($argc, $argv)
{
  // code to run
}
```

`$argc` and `$argv` in this method came from [$argc](http://php.net/manual/en/reserved.variables.argc.php) and [$argv](http://php.net/manual/en/reserved.variables.argv.php) without script name information, passed in [index.php](index.php). Although it has same variable name, please be careful that `$argc` and `$argv` in `run` method does not connected to the arguments linked in above.

## How to output result
You can use `print` functions in order to print your result into sdtout.

``` php
printf("%s\n", args);
```

## Install External Libraries
If you want to use external libraries, do the following:

- Add dependency information in [composer.json](composer.json)
