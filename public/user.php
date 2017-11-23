<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Medoo\Medoo;

$app = new Slim\App();

$DBuser = $app->getContainer();

$DBuser['database'] = function () {
	return new Medoo([
  'database_type' => 'sqlite',
  'database_file' => 'db/person.db'
	]);
};
//get api user
$app->get('/user',function (Request $request, Response $response) {
    $data = $this->database->select('user', '*');
    $result = json_encode($data);
    $response->getBody()->write($result);
    return $response;
});
// get api detail user
$app->get('/user/{id}',function (Request $request, Response $response) {
   $id = $request->getAttribute('id');
   $data = $this->database->select('user', '*', ['id'=>$id]);
   $result = json_encode($data);
   $response->getBody()->write($result);
   return $response;
});

// // Create Record User
// $app->post('/user/create', function($request, $response){
//         $data = $request->getParsedBody();
//         $this->database->insert("user",
//          [
//           "id" => $data["id"],
//          'name' => $data["name"]
//          ]);
//          return $response->getBody()->write($data);
//
// });
// //update user
// $app->put('/user/{id}', function($request, $response){
//         $data = $request->getParsedBody();
//       $this->database->SET("user",
//         [
//           "id" => $data["id"],
//          'name' => $data["name"]
//          ]);
//          return $response->getBody()->write($data);
//
// });
// $app->delete('/user/{id}', function($request, $response){
//         $this->database = $request->getParsedBody();
//         $database->DELETE ("user", [
//           "id" => $data["id"],
//          'name' => $data["name"]
//          ]);
//          return $response->getBody()->write($data);
//
// });

?>
