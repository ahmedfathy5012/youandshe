<?php

namespace Src\Base\Core\Storage;

Interface StorageImplement
{
    public function storeFile($file,string $path='images');
    public function getFile(string $file='',string $path='images'):string;
}
