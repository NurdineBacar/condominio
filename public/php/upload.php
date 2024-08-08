<?php
    $file_name = $_FILES['file']['name']; //pegando o nome do ficheiro
    $tmp_name = $_FILES['file']['tmp_name']; //pegando o tmp_name do ficheiro
    $file_up_name = time().$file_name;  //fazendo o nome do ficheiro dinamico adicionado o tempo antes do nome
    move_uploaded_file($tmp_name,"/".$file_up_name); // movendo o ficheiro para a pasta escolhida com o nome dinamico

?>