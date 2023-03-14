
<h3> CADASTRO DE NOVOS USUÁRIOS </h3>

<h4>Preencha seus dados para fazer parte dessa comunidade!</h4><br>
<form action="user-new.php" method="POST">

<label for="cpf">CPF</label>
<input type="text"name="cpf" id="cpf" placeholder="Ex: 000.000.000-00">
<label for="nome">NOME</label>
<input type="text" name="nome" id="nome" placeholder="Ex: Joao Paulo">
<label for="endereco">ENDEREÇO</label>
<input type="text" name="logradouro" id="logradouro" placeholder="Rua: Nova, 123">
<label for="cidade">CIDADE</label>
<input type="text" name="cidade" id="cidade" placeholder="Digite o nome da cidade">
<label for="uf">ESTADO</label>
<select name="uf" id="uf">
    <option value="AC">Acre (AC)</option>
    <option value="AL">Alagoas (AL)</option>
    <option value="AP">Amapá (AP)</option>
    <option value="AM">Amazonas (AM)</option>
    <option value="BA">Bahia (BA)</option>
    <option value="CE">Ceará (CE)</option>
    <option value="DF">Distrito Federal (DF)</option>
    <option value="ES">Espírito Santo (ES)</option>
    <option value="GO">Goiás (GO)</option>
    <option value="MA">Maranhão (MA)</option>
    <option value="MT">Mato Grosso (MT)</option>
    <option value="MS">Mato Grosso do Sul (MS)</option>
    <option value="MG">Minas Gerais (MG)</option>
    <option value="PA">Pará (PA)</option>
    <option value="PB">Paraíba (PB)</option>
    <option value="PR">Paraná (PR)</option>
    <option value="PE">Pernambuco (PE)</option>
    <option value="PI">Piauí (PI)</option>
    <option value="RJ">Rio de Janeiro (RJ)</option>
    <option value="RN">Rio Grande do Norte (RN)</option>
    <option value="RS">Rio Grande do Sul (RS)</option>
    <option value="RO">Rondônia (RO)</option>
    <option value="RR">Roraima (RR)</option>
    <option value="SC">Santa Catarina (SC)</option>
    <option value="SP">São Paulo (SP)</option>
    <option value="SE">Sergipe (SE)</option>
    <option value="TO">Tocantins (TO)</option>     
</select>

<label for="telefone">TELEFONE</label>
<input type="text" name="telefone" id="telefone" placeholder="Ex: (00)0000-0000">
<label for="email">EMAIL</label>
<input type="text" name="email" id="email" placeholder="Ex: mail@mail.com.br">
<label for="senha">SENHA</label>
<input type="password" name="senha1" id="senha1" >
<label for="senha">REPITA SUA SENHA</label>
<input type="password" name="senha2" id="senha2" >
<label for="tipo">TIPO</label>
<select name="tipo" id="tipo">
    <option value="1">Administrador</option>
    <option value="2" selected>Usuário Padrão</option>
</select>
<label for="foto">FOTO * Campo não obrigatório</label>
<input type="file" name="foto" id="foto" placeholder="SUAFOTINHOAQUI">

<input type="submit" value="CADASTRAR">

<?php 
    echo voltar();
?>
