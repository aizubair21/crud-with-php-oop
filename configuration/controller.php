<?php

class controller
{

    //is input empty
    public function required($property, string $errorProperty)
    {

        if (empty($property)) {
            $this->{$errorProperty} = "Field is required*";
        }
    }

    //unique method
    public function unique($uniqueProperty, string $table, string $where)
    {




        // $qry = " SELECT * FROM $table WHERE $where = '$uniqueProperty}'";
        // $result = $this->mysqli->query($qry)->num_rows;

        $Db = new DBSelect;
        $Db->select([])->from($table)->where(" $where = '$uniqueProperty'");
        $result = $Db->get()->num_rows;
        return $result;
    }

    // //valid email 
    public function isValidEmail($property, string $errorProperty)
    {
        if (!empty($property)) {
            if (filter_var($property, FILTER_VALIDATE_EMAIL)) {
                $this->{$property} = $property;
            } else {
                $this->{$errorProperty} = "Giva a valid email";
            }
        } else {
            $this->{$errorProperty} = "Field is required.";
        }
    }

    //errorShow into sebsite;
    public function isError($errorValue)
    {
        if (isset($errorValue)) {

            echo "<div><strong class='text text-danger'> $errorValue </strong></div>";
        }
        if (empty($errorValue)) {

            echo "<div><strong class='text text-success'> Good </strong></div>";
        }
    }
}