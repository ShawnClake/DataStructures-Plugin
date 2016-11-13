<?php

/**
 *	Created by Shawn Clake
 *  Uses an October collection to create an auto resizing grid.
 *	
*/

namespace Clake\DataStructures\Classes;


use Illuminate\Support\Collection;

class Grid
{
    private $rowNum;
    private $colNum;
    private $maxCols;
    private $grid = []; // Each index is a row

    public static function init($cols = 3, $rows = 0, $styleMaxCols = 12)
    {
        $o = new static;
        $o->rowNum = $rows;
        $o->colNum = $cols;
        $o->maxCols = $styleMaxCols;
        return $o;
    }

    public function gridify(Collection $d)
    {
        if($this->rowNum == 0)
            $this->rowNum = ceil($d->count() / $this->colNum);

        for($i = 0; $i < $this->rowNum; $i++)
        {
            array_push($this->grid, $d->forPage($i + 1, $this->colNum));
        }

        return $this;

    }

    public function get()
    {
        return $this->grid;
    }

    public function getIndex($col, $row)
    {
        $r = $this->grid[$row];
        return $r[$col];
    }

    public function getRow($row)
    {
        return $this->grid[$row];
    }

    public function getRowCount()
    {
        return $this->rowNum;
    }

    public function getColCount()
    {
        return $this->colNum;
    }

    public function getColStyleSize()
    {
        return ceil($this->maxCols / $this->colNum);
    }

    public function getSmallColStyleSize()
    {
        $size = ceil($this->maxCols / $this->colNum) * 4;
        if($size > 12)
            $size = 12;
        return $size;
    }

    public function getMediumColStyleSize()
    {
        $size = ceil($this->maxCols / $this->colNum) * 2;
        if($size > 12)
            $size = 12;
        return $size;
    }

    public function getAllColStyleSize()
    {
        return [
            's' => $this->getSmallColStyleSize(),
            'm' => $this->getMediumColStyleSize(),
            'l' => $this->getColStyleSize()
        ];
    }

}