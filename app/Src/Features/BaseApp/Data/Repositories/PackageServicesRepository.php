<?php

namespace Src\Features\BaseApp\Data\Repositories;



use Src\Base\Repositories\Repository;
use Src\Features\BaseApp\Data\Models\PackageService;

class PackageServicesRepository extends Repository
{
    public function __construct(PackageService $packageService)
    {
        $this->setModel($packageService);
    }


    public function deleteRow($serviceId=0,$packageId=0): bool
    {
       $row = $this->getModel()->where('server_id',$serviceId)->Where('package_id',$packageId)->first();
       return $this->delete($row->id);
    }
}
