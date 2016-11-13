<?php

namespace Clake\DataStructures\Classes;

use Illuminate\Support\Collection;

class Lists extends Collection
{

    private $list;
    private $limit = 10;

    public static function create(Collection $c = null)
    {
        $o = new static();
        if($c != null)
            $o->list = $c;
        else
            $o->list = new Collection;
        return $o;
    }

    public function get()
    {
        return $this->list->take($this->limit);
    }

    public function set(Collection $c)
    {
        $this->list = $c;
        return $this;
    }

    public function push(Collection $c)
    {
        $this->list->merge($c);
        return $this;
    }

    public function limit($limit = 10)
    {
        $this->limit = $limit;
        return $this;
    }

}