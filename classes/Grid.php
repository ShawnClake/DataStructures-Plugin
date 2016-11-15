<?php

/**
 *	Created by Shawn Clake
 *  Uses an October collection to create an auto resizing grid.
 *	
*/

namespace Clake\DataStructures\Classes;


use Illuminate\Support\Collection;

/**
 * Class Grid
 * @package Clake\DataStructures\Classes
 */
class Grid
{
    private $rowNum;
    private $colNum;
    private $maxCols;
    private $grid = []; // Each index is a row

    /**
     * Factory method for creating a new grid
     * @param int $cols
     * @param int $rows
     * @param int $styleMaxCols
     * @return static
     */
    public static function init($cols = 3, $rows = 0, $styleMaxCols = 12)
    {
        $o = new static;
        $o->rowNum = $rows;
        $o->colNum = $cols;
        $o->maxCols = $styleMaxCols;
        return $o;
    }

    /**
     * Takes a set of data and turns it into a grid
     * @param Collection $d
     * @return $this
     */
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

    /**
     * Return the 2D grid array
     * @return array
     */
    public function get()
    {
        return $this->grid;
    }

    /**
     * Return the data at the given row and column
     * @param $col
     * @param $row
     * @return mixed
     */
    public function getIndex($col, $row)
    {
        $r = $this->grid[$row];
        return $r[$col];
    }

    /**
     * Returns a row of the data
     * @param $row
     * @return mixed
     */
    public function getRow($row)
    {
        return $this->grid[$row];
    }

    /**
     * Returns the numbers of rows in the grid
     * @return mixed
     */
    public function getRowCount()
    {
        return $this->rowNum;
    }

    /**
     * Return the number of columns in the grid
     * @return mixed
     */
    public function getColCount()
    {
        return $this->colNum;
    }

    /**
     * Returns the CSS style column size for this grid
     * @return float
     */
    public function getColStyleSize()
    {
        return ceil($this->maxCols / $this->colNum);
    }

    /**
     * Returns a responsive small window size column size. Currently only works with
     * CSS grids with a max of 12 columns
     * @return float|int
     */
    public function getSmallColStyleSize()
    {
        $size = ceil($this->maxCols / $this->colNum) * 4;
        if($size > 12)
            $size = 12;
        return $size;
    }

    /**
     * Returns a responsive medium window size column size. Currently only works with
     * CSS grids with a max of 12 columns
     * @return float|int
     */
    public function getMediumColStyleSize()
    {
        $size = ceil($this->maxCols / $this->colNum) * 2;
        if($size > 12)
            $size = 12;
        return $size;
    }

    /**
     * Returns an array of the responsive design column measurements for small, medium, and large screens
     * @return array
     */
    public function getAllColStyleSize()
    {
        return [
            's' => $this->getSmallColStyleSize(),
            'm' => $this->getMediumColStyleSize(),
            'l' => $this->getColStyleSize()
        ];
    }

}