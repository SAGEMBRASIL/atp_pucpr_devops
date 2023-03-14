<?php 

// FUNÇÕES REFERENTES A LOGIN E LOGOUT DE USUARIO:
// inicio as variaveis de sessao caso esteja vazia:
session_start();

if (!isset($_SESSION['user']))
{
$_SESSION['user'] = null;
$_SESSION['nome'] = null;
$_SESSION['tipo'] = null;
}

// gero uma hash para senha:
function gerarHash($senha){
    $hash = password_hash($senha, PASSWORD_DEFAULT);
    return $hash;
}

// testo a hash para verificar se a senha enviada corresponde a hash salva no banco.
function testarHash($senha, $hash){
    $ok = password_verify($senha, $hash);
    return $ok;
}

// Faço o logout do usuario fazendo o unset das variaveis de sessao:
function logout(){
    unset($_SESSION['user']);
    unset($_SESSION['nome']);
    unset($_SESSION['tipo']);
}

// verifico se o usuário está logado, se sessão estiver vazia, não está.
function is_logado(){
    if (empty($_SESSION['user'])){
        return false;
    }else{
        return true;
    }
}

// verifico se o usuário é do tipo '1' = ADMIN.
function is_admin(){
    $t = $_SESSION['tipo'] ?? null;
    if(is_null($t)){
        return false;
    }else {
        if ($t == '1'){
            return true;
        }else{
            return false;
        }
    }

}


// verifico se o usuário é do tipo '2' = EDITOR.
function is_editor(){
    $t = $_SESSION['tipo'] ?? null;
    if(is_null($t)){
        return false;
    }else {
        if ($t == '2'){
            return true;
        }else{
            return false;
        }
    }

}




?>