<?php
namespace Src\Base\Repositories;

use Src\Base\ResponseBuilder;
use Illuminate\Database\Eloquent\Model;

// interface RepositoryInterface {
//     public function all();
//     public function find($id): ?Model;
//     public function create(array $data): ?Model;
//     public function update(Model $model): ?Model;
//     public function delete($id): bool;
// }



interface RepositoryInterface {
    public function index();
    public function find($id): ?Model;
    public function create(array $data): ?Model;
    public function update(array $data): ?Model;
    public function delete($id): bool;
}
