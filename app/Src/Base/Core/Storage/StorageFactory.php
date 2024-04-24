<?php

namespace Src\Base\Core\Storage;

class StorageFactory
{
    static public function instance(string $type='server'):StorageImplement
    {
        $handler = config('storages.storages')[$type];
        return new $handler;
    }
}
