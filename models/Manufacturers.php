<?php
use Phalcon\Mvc\Model;

class Manufacturers extends Model {

    public function initialize() {
        //$this->hasMany("id","Cars","model_id");
    }

    public function validation() {
        // Car reg must be entered
        /*
        $this->validate(
            new PresenceOf(
                array(
                    'field' => "reg_no",
                    'message' => "Registration number cannot be blank"
                )
            )
        );*/

        // Car reg must be unique
        $this->validate(
            new Uniqueness(
                array(
                    "field" => "name",
                    "message" => "A manufacturer by this name already exists"
                )
            )
        );

        if ($this->validationHasFailed()) {
            return false;
        }
    }
}

?>