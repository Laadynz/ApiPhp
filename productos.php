<?php
header("Content-Type: application/json");
if(!empty($_GET['codigo']))
{
  $codigo = $_GET['codigo'];
  $mysqli = new mysqli("localhost", "root", "", "sistemapos");
  $result = $mysqli->query("SELECT nombre, precio FROM productos WHERE codigo = '$codigo'");
  $row = $result->fetch_assoc();
  
  if($row)
  {
    $data["nombre"] = $row['nombre'];
    $data["precio"] = $row['precio'];
    response(200,$data); #200 es el codigo de respuesta cuando se encuentra el producto
  }
  else
  {
    $data["nombre"] = "";
    $data["precio"] = "";
    response(300,$data);#300 es el codigo de respuesta cuando no se encuentra el producto
  }
}
else
{
  $data["nombre"] = "";
    $data["precio"] = "";
    response(400,$data);#400 es el codigo de respuesta cuando se llama mal al API
}


function response($status,$data)
{
  header("HTTP/1.1 ".$status);
  $response['status'] = $status;
  $response['nombre'] = $data['nombre'];
  $response['precio'] = $data['precio'];
  $json_response = json_encode($response);
  echo $json_response;
}