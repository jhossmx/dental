<?php
namespace App\Libraries;
use CodeIgniter\Model;

class TableLib
{
    //https://www.youtube.com/watch?v=ELZYkb7EJrE
    private $model;
    private $group;
    private $columns;

    public function __construct(Model $model, string $group, array $columns)
    {
        $this->model = $model;
        $this->group = $group;
        $this->columns = $columns;
    }

    public function getResponse(array $filters)
    {
        [
            'draw' => $draw,
            'length' => $length,
            'start' => $start,
            'order' => $order,
            'direction' => $direction,
            'search' => $search
        ] = $filters;

        $page = ceil(($start - 1) / $length + 1);
        
        if(!empty($search))
        {
           $this->applyFilters($search);
        }

        $data = $this->model
            ->orderBy($this->getColumn($order), $direction)
            ->paginate($length, $this->group, $page);

        //dd($data);


        return [
            'draw' => $draw,
            'recordsTotal' => $this->model->countAll(),
            'recordsFiltered' => $this->model->pager->getTotal($this->group),
            'data' => $data
        ];
    }

    private function getColumn($index)
    {
        return $this->columns[$index];
    }

    private function applyFilters(string $match)
    {
        foreach($this->columns as $column)
        {
            $this->model->orLike($column, $match);
        }
    }
}

?>