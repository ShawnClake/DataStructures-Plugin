<?php

namespace Clake\DataStructures\Classes;

/**
 * Class Enum
 * @package Clake\DataStructures\Classes
 */
class Enum
{
    /**
     * This array contains all of the possible ENUM values. Ensure this is overriden in any ENUM class
     * @var array
     */
    protected $enum = [];
    private $selected;

    /**
     * Ensures the selected ENUM is blank on creation
     * Enum constructor.
     */
    public function __construct()
    {
        $selected = null;
    }

    /**
     * Used to dynamically create ENUM objects.
     * IE. Enum::PENNY() will create an Enum object with PENNY selected
     * @param $value
     * @param $arg
     * @return static
     */
    public static function __callStatic($value, $arg)
    {
        $o = new static;
        if(in_array($value, $o->enum))
            $o->selected = $value;
        return $o;
    }

    /**
     * Used to dynamically set the set ENUM value
     * IE. $enum(PENNY) will set the $enum to PENNY and return the Enum
     * @return static
     */
    public static function __invoke($value)
    {
        $o = new static;
        if(in_array($value, $o->enum))
            $o->selected = $value;
        return $o;
    }

    /**
     * Equivalent of creating an ENUM and setting its selected state
     * IE. $enum->PENNY  returns the Enum set to PENNY if PENNY exists in the Enum
     * @param $value
     * @return Enum
     */
    public function __get($value)
    {
        if(in_array($value, $this->enum))
            $this->selected = $value;
        return $this;
    }

    /**
     * Used to compare two ENUM states
     * IE. $enum1->compare($enum2)
     * @param Enum $compare
     * @return bool
     */
    public function compare(Enum $compare)
    {
        if($compare->selected == $this->selected)
            return true;
        return false;
    }

}