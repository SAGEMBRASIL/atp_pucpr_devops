<!--FORMULARIO PARA EDIÇÃO DE DADOS USUARIO -->
<?php 
include_once 'topo.php';
require_once 'models/banco.php';
$q = "SELECT * FROM USUARIO WHERE email ='".$_SESSION['user']."'";
$busca = $banco->query($q)->fetch_object();

?>
<h1>Alteração de Dados</h1>


<form action="user-edit.php" method="POST">

<label for="email"> <strong> USUÁRIO: </strong></label>
<input type="email" name="email" id="email" value="<?php echo $busca->email?>" readonly>

<label for="nome">NOME</label>
<input type="text" name="nome" id="nome" value="<?php echo $busca->nome?>" >
<label for="endereco">ENDEREÇO</label>
<input type="text" name="logradouro" id="logradouro" value="<?php echo $busca->logradouro?>">
<label for="cidade">CIDADE</label>
<input type="text" name="cidade" id="cidade" value="<?php echo $busca->cidade?>">
<label for="uf">ESTADO</label>
<select name="uf" id="uf">
<?php $uf = $busca->uf?>
    
    <option value="AC"<?php if ($uf == "AC"){echo "selected";}?>>Acre (AC)</option>
    <option value="AL"<?php if ($uf == "AL"){echo "selected";}?>>Alagoas (AL)</option>
    <option value="AP"<?php if ($uf == "AP"){echo "selected";}?>>Amapá (AP)</option>
    <option value="AM"<?php if ($uf == "AM"){echo "selected";}?>>Amazonas (AM)</option>
    <option value="BA"<?php if ($uf == "BA"){echo "selected";}?>>Bahia (BA)</option>
    <option value="CE"<?php if ($uf == "CE"){echo "selected";}?>>Ceará (CE)</option>
    <option value="DF"<?php if ($uf == "DF"){echo "selected";}?>>Distrito Federal (DF)</option>
    <option value="ES"<?php if ($uf == "ES"){echo "selected";}?>>Espírito Santo (ES)</option>
    <option value="GO"<?php if ($uf == "GO"){echo "selected";}?>>Goiás (GO)</option>
    <option value="MA"<?php if ($uf == "MA"){echo "selected";}?>>Maranhão (MA)</option>
    <option value="MT"<?php if ($uf == "MT"){echo "selected";}?>>Mato Grosso (MT)</option>
    <option value="MS"<?php if ($uf == "MS"){echo "selected";}?>>Mato Grosso do Sul (MS)</option>
    <option value="MG"<?php if ($uf == "MG"){echo "selected";}?>>Minas Gerais (MG)</option>
    <option value="PA"<?php if ($uf == "PA"){echo "selected";}?>>Pará (PA)</option>
    <option value="PB"<?php if ($uf == "PB"){echo "selected";}?>>Paraíba (PB)</option>
    <option value="PR"<?php if ($uf == "PR"){echo "selected";}?>>Paraná (PR)</option>
    <option value="PE"<?php if ($uf == "PE"){echo "selected";}?>>Pernambuco (PE)</option>
    <option value="PI"<?php if ($uf == "PI"){echo "selected";}?>>Piauí (PI)</option>
    <option value="RJ"<?php if ($uf == "RJ"){echo "selected";}?>>Rio de Janeiro (RJ)</option>
    <option value="RN"<?php if ($uf == "RN"){echo "selected";}?>>Rio Grande do Norte (RN)</option>
    <option value="RS"<?php if ($uf == "RS"){echo "selected";}?>>Rio Grande do Sul (RS)</option>
    <option value="RO"<?php if ($uf == "RO"){echo "selected";}?>>Rondônia (RO)</option>
    <option value="RR"<?php if ($uf == "RR"){echo "selected";}?>>Roraima (RR)</option>
    <option value="SC"<?php if ($uf == "SC"){echo "selected";}?>>Santa Catarina (SC)</option>
    <option value="SP"<?php if ($uf == "SP"){echo "selected";}?>>São Paulo (SP)</option>
    <option value="SE"<?php if ($uf == "SE"){echo "selected";}?>>Sergipe (SE)</option>
    <option value="TO"<?php if ($uf == "TO"){echo "selected";}?>>Tocantins (TO)</option>     
</select>

<label for="telefone">TELEFONE</label>
<input type="tel" name="telefone" id="telefone" value="<?php echo $busca->telefone?>">

<label for="senha">SENHA</label>
<input type="password" name="senha1" id="senha1" placeholder="Digite uma nova senha">
<label for="senha">REPITA SUA SENHA</label>
<input type="password" name="senha2" id="senha2" placeholder="Digite uma nova senha">


<label for="foto">FOTO * Campo não obrigatório</label>
<input type="file" name="foto" id="foto" placeholder="fotos/<?php echo $busca->foto?>">


<input type="submit" value="SALVAR ALTERAÇÕES">


</form>