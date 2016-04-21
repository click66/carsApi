<?php
use Phalcon\Mvc\Controller;

class CarsController extends Controller
{
    public function index($id = null) {
        if (is_null($id)) {
            return $this->readAll();
        } else {
            return $this->read($id);
        }
    }

    // List all cars
    private function readAll() {
        return $this->response->setContent(json_encode(Cars::readAllArray()));
    }
    private function read($id) {
        $data = Cars::readArray($id);

        if ($data === false ) {    // Non-existent ID; car not found
            return $this->response->setStatusCode(404,"Not Found");
        }

        return $this->response->setContent(json_encode($data));
    }

    public function create() {
        $data = $this->request->getJsonRawBody();
        if (is_null($data)) {
            return $this->response->setStatusCode(400,"No data sent");
        }

        $car = Cars::factory($data->reg_no,isset($data->colour) ? $data->colour : null,isset($data->year) ? $data->year : null);
        if (isset($data->model) && !is_null($data->model)) {
            $car->setModel($data->model);
        }

        if ($car->save() === false) {
            $messages = array();
            foreach ($car->getMessages() as $message) {
                $messages[] = $message;
            }
            return $this->response->setContent(json_encode(array(
                "success" => 0,
                $message = $messages
            )));
        } else {
            return $this->response->setContent(json_encode(array(
                "success" => 1,
                "messages" => array()
            )));
        }
    }

    public function update($id) {
        $data = $this->request->getJsonRawBody();
        if (is_null($data)) {
            return $this->response->setStatusCode(400,"No data sent");
        }

        $car = Cars::findFirst($id);
        if ($car === false) {
            return $this->response->setStatusCode(404,"Not Found");
        }

        $car->reg_no = $data->reg_no;
        if (isset($data->colour) && (!is_null($data->colour) || (is_null($data->colour) && !is_null($car->colour)))) {
            $car->colour = $data->colour;
        }
        if (isset($data->year) && (!is_null($data->year) || (is_null($data->year) && !is_null($car->year)))) {
            $car->year = $data->year;
        }
        if (isset($data->model) && !is_null($data->model)) {
            $car->setModel($data->model);
        }

        if ($car->save() === false ) {
            $messages = array();
            foreach ($car->getMessages() as $message) {
                $messages[] = $message;
            }
            return $this->response->setContent(json_encode(array(
                "success" => 0,
                "messages" => $messages
            )));
        } else {
            return $this->response->setContent(json_encode(array(
                "success" => 1,
                "messages" => array()
            )));
        }
    }

    public function delete($id) {
        // TODO
    }
}
?>