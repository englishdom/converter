<?php

namespace Convertor\Filter;

interface FilterInterface
{
    public function filter($text): string;
}