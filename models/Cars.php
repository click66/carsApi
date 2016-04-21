<?php
use Phalcon\Mvc\Model;
use Phalcon\Di;

class Cars extends Model {

    public static function factory($reg_no,$colour = null,$year = null) {
        $car = new Cars();
        $car->reg_no = $reg_no;
        if (!is_null($colour)) {
            $car->colour = $colour;
        }
        if (!is_null($year)) {
            $car->year = $year;
        }
    }
    public function setModel($modelName) {
        $condition = "name = :name:";
        $parameters = array(
            'name' => $modelName
        );

        $m = Models::findFirst(array(
            $condition,
            "bind" => $parameters
        ));

        if ($m === false) { // Invalid manufacturer name
            return false;
        }

        $this->model_id = $m->id;

        return true;
    }

    // CRUD
    public static function readArray($id) {
        $m = Cars::findFirst($id);
        if ($m === false) { // Bad ID; car doesn't exist
            return false;
        }

        // Get model
        $model = "";
        $manufacturer = "";
        if (!is_null($m->model_id)) {
            $m_model = Models::findFirst($m->model_id);
            if ($m_model !== false) {
                $model = $m_model->name;
            }

            // Get manufacturer
            if (!is_null($m_model->manufacturer_id)) {
                $m_manufacturer = Manufacturers::findFirst($m_model->manufacturer_id);
                if ($m_manufacturer !== false) {
                    $manufacturer = $m_manufacturer->name;
                }
            }
        }

        return array(
            "reg_no" => $m->reg_no,
            "model" => $model,
            "manufacturer" => $manufacturer,
            "colour" => $m->colour,
            "year" => $m->year
        );
    }
    public static function readAllArray() {
        $phql = "SELECT 
                    c.id,c.reg_no,c.colour,c.year,
                    m.name AS model_name,
                    mf.name AS manufacturer_name
                  FROM
                    cars c
                      LEFT JOIN models m ON c.model_id = m.id
                      LEFT JOIN manufacturers mf ON m.manufacturer_id = mf.id
                  ORDER BY c.reg_no ASC

        ";

        $cars = Di::getDefault()['modelsManager']->executeQuery($phql);
        $data = array();
        foreach ($cars as $car) {
            $data[] = array(
                "reg_no" => $car->reg_no,
                "model" => is_null($car->model_name) ? "" : $car->model_name,
                "manufacturer" => is_null($car->manufacturer_name) ? "" : $car->manufacturer_name,
                "colour" => $car->colour,
                "year" => $car->year
            );
        }

        return $data;
    }

    public function initialize() {
        //$this->belongsTo("model_id","Models","id");
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
                    "field" => "reg_no",
                    "message" => "Registration Number already exists"
                )
            )
        );

        // Year cannot be less than zero
        if ($this->year < 0) {
            $this->appendMessage(new Message("The year cannot be less than zero"));
        }

        if ($this->validationHasFailed()) {
            return false;
        }
    }
}

?>