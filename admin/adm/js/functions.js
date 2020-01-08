 
 
//Configurações para o Ajax - setar campos para ordens e buscas
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
var navegador = navigator.userAgent.toLowerCase(); //Cria e atribui à variável global 'navegador' (em caracteres minúsculos) o nome e a versão do navegador
var xmlhttp; //Cria uma variável global chamada 'xmlhttp'

//Função que inicia o objeto XMLHttpRequest
function objetoXML() {
	if (navegador.indexOf('msie') != -1) { //Internet Explorer
		var controle = (navegador.indexOf('msie 5') != -1) ? 'Microsoft.XMLHTTP' : 'Msxml2.XMLHTTP'; //Operador ternário que adiciona o objeto padrão do seu navegador (caso for o IE) à variável 'controle'
		try {
			xmlhttp = new ActiveXObject(controle); //Inicia o objeto no IE
		} catch (e) { }
	} else { //Firefox, Safari, Mozilla
		xmlhttp = new XMLHttpRequest(); //Inicia o objeto no Firefox, Safari, Mozilla
	}
}

//Função que envia o formulário
function enviarForm(url, campos, destino) {
	var elemento = document.getElementById(destino); //Atribui à variável 'elemento' o elemento que irá receber a página postada
	objetoXML(); //Executa a função objetoXML()
	if (!xmlhttp) { //Se o objeto de 'xmlhttp' não estiver true
		elemento.innerHTML = 'Impossível iniciar o objeto XMLHttpRequest.'; //Insere no 'elemento' o texto atribuído
		return;
	} else { //Senão
		elemento.innerHTML = 'Carregando...'; //Insere no 'elemento' o texto atribuído
	}
	xmlhttp.onreadystatechange = function () {
    	if (xmlhttp.readyState == 4 || xmlhttp.readyState == 0) { //Se a requisição estiver completada
    		if (xmlhttp.status == 200) { //Se o status da requisição estiver OK
    			elemento.innerHTML = xmlhttp.responseText; //Insere no 'elemento' a página postada
    		} else { //Senão
    			elemento.innerHMTL = 'Página não encontrada!'; //Insere no 'elemento' o texto atribuído
    		}
    	}
	}
	xmlhttp.open('POST', url+'?'+campos, true); //Abre a página que receberá os campos do formulário
	xmlhttp.send(campos); //Envia o formulário com dados da variável 'campos' (passado por parâmetro)
}
	
// Select para mandar para outra pagina
function fMudarPagina(){
    with(document.frmMudar){
        action = sltMudar.value;
        submit();
    }
}
// FIM Select para mandar para outra pagina