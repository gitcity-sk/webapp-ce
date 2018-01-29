<?php

namespace App\Api\Git;

class BaseModel
{
    /**
     * method _getVariables
     */
    protected function _getVariables()
    {
        return get_object_vars($this);
    }

    protected function withClosure()
    {
        return [
            'data' => $this->tree
        ];
    }

    /**
     * method toArray
     * @deprecated
     */
    public function toArray()
    {
        // read all model variables into array
        $tmpArray = get_object_vars($this);

        // initialize empty array
        $newArray = [];

        foreach ($tmpArray as $key => $value) {
            // check if its base model
            if ($this->$key instanceof BaseModel) {
                $newArray[$key] = $this->$key->toArray();
            }  else if (is_array($this->$key)) {
                
                // check if its array
                foreach ($this->$key as $id => $item) {
                    //check if item in array is baseModel
                    if ($item instanceof BaseModel) {
                        $newArray[$key][$id] = $item->toArray();
                    } else {
                        $newArray[$key][$id] = $item;
                    }
                }

            } else {
                // simple variables just add to array
                $newArray[$key] = $value;
            }
        }

        return $newArray;
    }

}