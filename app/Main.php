<?php namespace Codecheck;

function run ($argc, $argv)
{
  foreach ($argv as $index=>$value) {
    printf("argv[%s]: %s\n", $index, $value);
  }
}
