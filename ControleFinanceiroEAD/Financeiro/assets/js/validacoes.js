// Validações: Tela Meus Dados. //

function ValidarMeusDados() {
    var nome = $("#nomeUsuario").val();
    var email = $("#emailUsuario").val();
    var senha = $("#senha").val();

    if (nome.trim() == '') {
        alert("Preencha o campo obrigatório NOME!"); 
        $("#nomeUsuario").focus();
        return false;
    }
    if (email.trim() == '') {
        alert("Preencha o campo obrigatório E-MAIL!");
        $("#emailUsuario").focus();
        return false;
    }

    if ($("#senha").val().trim()== ''){
        alert ("Preencha o campo obrigatório SENHA!");
        $("#senha"). focus();
        return false;
    }
}

// Validações: Tela Categoria. //

function ValidarCategoria() {
    if ($("#nomeCategoria").val().trim() == '') {
        alert("Preencha o campo obrigatório NOME DA CATEGORIA!");
        $("#nomeCategoria").focus();
        return false;
    }

}

// Validações: Tela Empresa. // 

function ValidarEmpresa() {
    if ($("#nomeEmp").val().trim() == '') {
        alert("Preencha o campo obrigatório NOME DA EMPRESA!");
        $("#nomeEmp").focus();
        return false;
    }
    if ($("#telefone").val().trim() == ''){
        alert("Preencha o campo obrigatório TELEFONE!");
        $("#telefone").focus();
        return false;
    }
    if($("#endereco").val().trim() == ''){
        alert("Preencha o campo obrigatório ENDEREÇO!");
        $("#endereco").focus();
        return false;
    }
}

// Validações: Tela Conta. //

function ValidarConta() {

    if ($("#banco").val().trim() == '') {
        alert("Preencha o campo obrigatório: NOME DO BANCO!");
        $("#banco").focus();
        return false;
    }
    if ($("#agen").val().trim() == '') {
        alert("Preencha o campo obrigatório: AGÊNCIA!");
        $("#agen").focus();
        return false;
    }
    if ($("#num").val().trim() == '') {
        alert("Preencha o campo obrigatório: NÚMERO DA CONTA!");
        $("#num").focus();
        return false;
    }
    if ($("#saldo").val().trim() == '') {
        alert("Preencha o campo obrigatório: SALDO!");
        $("#saldo").focus();
        return false;
    }
}

// Validações: Tela Movimento. //

function ValidarMovimento() {
    if ($("#tipo").val().trim() == '') {
        alert("Preencha o campo obrigatório TIPO DE MOVIMENTO!");
        $("#tipo").focus();
        return false;
    }
    if ($("#data").val().trim() == '') {
        alert("Preencha o campo obrigatório DATA");
        $("#data").focus();
        return false;
    }
    if ($("#valor").val().trim() == '') {
        alert("Preencha o campo obrigatório VALOR (R$)!");
        $("#valor").focus();
        return false;
    }
    if ($("#categoria").val().trim() == '') {
        alert("Preencha o campo obrigatório CATEGORIA FINANCEIRA!");
        $("#categoria").focus();
        return false;
    }
    if ($("#empresa").val().trim() == '') {
        alert("Preencha o campo obrigatório EMPRESA!");
        $("#empresa").focus();
        return false;
    }
    if ($("#conta").val().trim() == '') {
        alert("Preencha o campo obrigatório CONTA!");
        $("#conta").focus();
        return false;
    }
}

// Validações: Tela Login. //

function ValidarLogin() {
    if ($("#email").val().trim() == '') {
        alert("Preencha o campo obrigatório E-MAIL!");
        $("#email").focus();
        return false;
    }
    if ($("#senha").val().trim() == '') {
        alert("Preencha o campo obrigatório SENHA!");
        $("#senha").focus();
        return false;
    }
    if ($("#senha").val().trim().length < 6 || $("#senha").val().trim().length > 8) {
        alert("A SENHA deve conter 6 a 8 caracteres!");
        $("#senha").focus();
        return false;
    }
}

// Validações: Tela Cadastro.
function ValidarCadastro() {
    if ($("#nomeUsuario").val().trim() == '') {
        alert("Preencha o campo obrigatório NOME!");
        $("#nomeUsuario").focus();
        return false;
    }
    if ($("#emailUsuario").val().trim() == '') {
        alert("Preencha o campo obrigatório E-MAIL!");
        $("#emailUsuario").focus();
        return false;
    }
    if ($("#senha").val().trim() == '') {
        alert("Preencha o campo obrigatório SENHA!");
        $("#senha").focus();
        return false;
    }
    if ($("#repSenha").val().trim() == '') {
        alert("Preencha o campo obrigatório REPETIR SENHA!");
        $("#repSenha").focus();
        return false;
    }
    if ($("#senha").val().trim() != $("#repSenha").val().trim()) {
        alert("As senhas devem ser IGUAIS!");
        $("#repSenha").focus();
        return false;
    }
    if ($("#senha").val().trim().length < 6 || $("#senha").val().trim().length > 8) {
        alert("A SENHA deve conter 6 a 8 caracteres!");
        $("#senha").focus();
        return false;
    }
}

// Validação de Campos: Tela de Realizar Movimento.
function ValidarRealizarMovimento(){
    if($("#tipo").val() == ''){
        alert("Selecione um TIPO DE MOVIMENTO!");
        $("#tipo").focus();
        return false;
    }

    if($("#data").val() == ''){
        alert("Selecione uma DATA!");
        $("#data").focus();
        return false;
    }

    if($("#valor").val().trim() == ''){
        alert("Preencha o campo obrigatório VALOR (R$)!");
        $("#valor").focus();
        return false;
    }

    if($("#categoria").val() == ''){
        alert("Selecione uma CATEGORIA FINANCEIRA!");
        $("#categoria").focus();
        return false;
    }

    if($("#empresa").val() == ''){
        alert("Selecione uma EMPRESA!");
        $("#empresa").focus();
        return false;
    }

    if($("#conta").val() == ''){
        alert("Selecione uma CONTA BANCÁRIA!");
        $("#conta").focus();
        return false;
    }
}

// Validação de Campos: Tela de Consultar Movimento.
function ValidarConsultarMovimento(){
    if($("#tipoMov").val() == ''){
        alert("Selecione um TIPO DE MOVIMENTO!");
        $("#tipoMov").focus();
        return false;
    }
    
    if($("#dtInicio").val() == ''){
        alert("Selecione uma DATA INICIAL!");
        $("#dtInicio").focus();
        return false;
    }

    if($("#dtFinal").val() == ''){
        alert("Selecione uma DATA FINAL!");
        $("#dtFinal").focus();
        return false;
    }
}
