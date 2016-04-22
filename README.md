# carsApi

## Example calls
### List all cars
curl -i -X GET http://localhost/cars

### Read single car
curl -i -X GET http://localhost/cars/8

### Create new car
curl -i -X POST -D '{"reg_no":"REGI NUM","colour":"Black","model":"Focus","year":"2015"}' http://localhost/cars

### Update existing car
curl -i -X PUT -D '{"reg_no":"C 3P0","colour":"Red"}' http://localhost/cars/4

curl -i -X PUT -D '{"reg_no":"C 3P0","colour":"Gold"}' http://localhost/cars/4