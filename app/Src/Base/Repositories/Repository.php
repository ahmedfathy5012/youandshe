<?php
namespace Src\Base\Repositories;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Src\Base\Repositories\RepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Src\Features\Auth\Data\Models\User;
use Src\Features\Blog\Data\Models\Blog;

class Repository implements RepositoryInterface
{


    private Model $model;


	/**
	 * @return mixed
	 */
	public function index(int $paginate = 0) {
        try{
            if($paginate>0){
                 return $this->model::paginate($paginate);
            }else{
                return $this->model->all();
            }
        }catch (Exception $e)
        {
            exceptionResponse(message:$e->getMessage());
        }
	}


    /**
     * @return mixed
     */
    public function indexWhere(string $key,$value,$paginate = 0) {
        try{
           return $this->model->where($key,$value)->get();
        }catch (Exception $e)
        {
            exceptionResponse(message:$e->getMessage());
        }
    }



    /**
     * @return mixed
     */
    public function index2(int $paginate =0,) {
        try{
            if($paginate>0){
                return $this->model::paginate($paginate);
            }else{
                return $this->model->all();
            }
        }catch (Exception $e)
        {
            exceptionResponse(message:$e->getMessage());
        }
    }




    /**
     * @return mixed
     */
    public function indexPagination() {
        try{
            return $this->model->Paginate(15);
        }catch (Exception $e)
        {
            exceptionResponse(message:$e->getMessage());
        }
    }



	/**
	 *
	 * @param mixed $id
	 * @return Illuminate\Database\Eloquent\Model|null
	 */
	public function find($id): ?Model {
        return $this->model->find($id);
	}


    /**
     *
     * @param mixed $key
     * @param mixed $value
     * @return Illuminate\Database\Eloquent\Model|null
     */
    public function checkExist($key,$value): ?Model
    {
        return $this->getModel()->where($key,$value)->first();
    }


	/**
	 *
	 * @param Illuminate\Database\Eloquent\Model $model
	 * @return Illuminate\Database\Eloquent\Model|null
	 */
	public function create(array $data): ?Model {
        try {

            foreach($data as $field => $val){
                if(in_array($field, $this->model->getFillable())){
                    $this->model->{$field} = $val;
                }
            }
            $this->model->save();
            return $this->model;
        }catch (Exception $e){
            exceptionResponse(message:$e->getMessage());
        }
	}

	/**
	 *
	 * @param Illuminate\Database\Eloquent\Model $model

	 */
	public function update(array $data): ?Model {
//        dd($data);
        try{
            $model = $this->find($data['id']);
            if($model){
                foreach($data as $field => $val){
                    if(in_array($field, $model->getFillable())){
                        $model->{$field} = $val;
                    }
                }
                $model->save();
                return $model;
            }else{
                return null;
            }
        }catch (Exception $e){
            throw exceptionResponse(message:$e??'');
        }
	}

	/**
	 *
	 * @param mixed $id
	 * @return bool
	 */
	public function delete($id): bool {
        try{
            $result = $this->find($id);
            if($result){
                $this->model = $result;
                return $this->model->delete();
            }else{
                return false;
            }

        }catch (Exception $e){
            exceptionResponse(message:$e->getMessage());
        }

	}



	/**
	 * @param Illuminate\Database\Eloquent\Model $model
	 * @return self
	 */
	public function setModel(Model $model): self {
		$this->model = $model;
		return $this;
	}


	public function getModel(): Model {
		return  $this->model;
	}
}
