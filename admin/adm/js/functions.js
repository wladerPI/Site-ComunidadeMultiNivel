 
 
//Configura��es para o Ajax - setar campos para ordens e buscas
function setarCampos_busca_cap_emails() {
campos = "busca_cap_emails="+(document.getElementById('busca_cap_emails').value);
}
  
/**/
function escondeAdm(n){
evt=n;
	if(evt == "1"){
	func1=document.getElementById("adm1");
	func2=document.getElementById("divResultado");
	func1.style.visibility="hidden";
	func2.style.visibility="visible";
	}
}

function escondeRes(n){
evt=n;
	if(evt == "1") {
	func1=document.getElementById("divResultado");
	func1.style.visibility="hidden";
	}
}

	//  ajax.js
var navegador = navigator.userAgent.toLowerCase(); //Cria e atribui � vari�vel global 'navegador' (em caracteres min�sculos) o nome e a vers�o do navegador
var xmlhttp; //Cria uma vari�vel global chamada 'xmlhttp'

//Fun��o que inicia o objeto XMLHttpRequest
function objetoXML() {
	if (navegador.indexOf('msie') != -1) { //Internet Explorer
		var controle = (navegador.indexOf('msie 5') != -1) ? 'Microsoft.XMLHTTP' : 'Msxml2.XMLHTTP'; //Operador tern�rio que adiciona o objeto padr�o do seu navegador (caso for o IE) � vari�vel 'controle'
		try {
			xmlhttp = new ActiveXObject(controle); //Inicia o objeto no IE
		} catch (e) { }
	} else { //Firefox, Safari, Mozilla
		xmlhttp = new XMLHttpRequest(); //Inicia o objeto no Firefox, Safari, Mozilla
	}
}

//Fun��o que envia o formul�rio
function enviarForm(url, campos, destino) {
	var elemento = document.getElementById(destino); //Atribui � vari�vel 'elemento' o elemento que ir� receber a p�gina postada
	objetoXML(); //Executa a fun��o objetoXML()
	if (!xmlhttp) { //Se o objeto de 'xmlhttp' n�o estiver true
		elemento.innerHTML = 'Imposs�vel iniciar o objeto XMLHttpRequest.'; //Insere no 'elemento' o texto atribu�do
		return;
	} else { //Sen�o
		elemento.innerHTML = 'Carregando...'; //Insere no 'elemento' o texto atribu�do
	}
	xmlhttp.onreadystatechange = function () {
    	if (xmlhttp.readyState == 4 || xmlhttp.readyState == 0) { //Se a requisi��o estiver completada
    		if (xmlhttp.status == 200) { //Se o status da requisi��o estiver OK
    			elemento.innerHTML = xmlhttp.responseText; //Insere no 'elemento' a p�gina postada
    		} else { //Sen�o
    			elemento.innerHMTL = 'P�gina n�o encontrada!'; //Insere no 'elemento' o texto atribu�do
    		}
    	}
	}
	xmlhttp.open('POST', url+'?'+campos, true); //Abre a p�gina que receber� os campos do formul�rio
	xmlhttp.send(campos); //Envia o formul�rio com dados da vari�vel 'campos' (passado por par�metro)
}
	
// Select para mandar para outra pagina
function fMudarPagina(){
    with(document.frmMudar){
        action = sltMudar.value;
        submit();
    }
}
// FIM Select para mandar para outra pagina