<?php

require_once "./ARCHIVOS.php";

$email = $_POST["email"]??"";
$tipodeUser = $_POST["tipodeUser"]??"";
$clave = $_POST["clave"]??"";
$foto = $_POST["foto"]??"NoFoto";

#region Validacion de input
if($email == "" || $email == null){
    echo "No se ingreso un email";
}else{
    echo "Email: ".$email;
}
if($clave == "" || $clave == null){
    echo "\nNo se ingreso un clave";
}else{
    echo "\nclave: $clave";
}
if($foto == "NoFoto" || $foto == null){
    echo "\nNo se ingreso un foto\n\n\n";
}else{
    echo "\nFoto: $foto\n\n\n";
}
#endregion


$dato= array("email"=>$email, "clave"=>$clave, "foto"=>$foto);

#region Manipulacion de archivo

    #region creo/abro archivo
        $archivo = AbrirArchivo("./user.json","a+");

    
        $theBigArray=array();
        $lectura="";
        while(!feof($archivo)){
            $lectura=$lectura . fgets($archivo);
        }
        if($lectura != null &&  $lectura != ""){

            $theBigArray=(array)json_decode($lectura);
            
        }

        fclose($archivo);

    #endregion

    #region Guardo archivo    
        $archivo = AbrirArchivo("./user.json","w+");
        array_push($theBigArray,$dato);
        $datoJson=json_encode($theBigArray);

        echo $datoJson;
        fwrite($archivo,$datoJson);

        fclose($archivo);
    #endregion

    
#endregion
?>