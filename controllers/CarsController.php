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

        $car = Cars::factory($data->reg_no,$data->colour,$data->year);
        if (!is_null($data->model)) {
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

        $car = Car::fetchFirst($id);
        if ($car === false) {
            return $this->response->setStatusCode(404,"Not Found");
        }

        $car->reg_no = $data->reg_no;
        $car->colour = $data->colour;
        $car->year = $data->year;
        if (!is_null($data->model)) {
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