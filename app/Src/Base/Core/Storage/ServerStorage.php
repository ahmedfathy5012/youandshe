<?php

namespace Src\Base\Core\Storage;

class ServerStorage implements StorageImplement
{
    public function storeFile($file,string $path='images')
    {
        $imageName = time().'.'.$file->extension();
        $file->move(public_path($path), $imageName);
        return $imageName;
    }

    public function getFile(string $file='',string $path='images'): string
    {
        return 'http://localhost:8000/images/'.$file;
//      return 'http://localhost:8000/images/' . $file??'';
    }
}
