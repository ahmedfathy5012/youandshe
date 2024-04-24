<?php


class StorageTest
{
    static public function applyServerStorage():void
    {
        dd(config('storagesystem.storages')[0].getFile());
    }
}
