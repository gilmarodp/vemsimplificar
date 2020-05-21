const URLPAGE = "https://www.vemsimplificar.com.br";

function trim(str) {
	return str.replace(/^\s+|\s+$/g,"");
}

function validateQuestion(id1, id2) {
    var content1 = trim(document.getElementById(id1).textContent);
    var content2 = trim(document.getElementById(id2).textContent);

    if (content1 === "" || content2 === "") {
        location.href = URLPAGE + "/materiais/resolucoes/2020-1";
        window.alert('A resolução dessa questão ainda não está pronta, se tiver dúvidas, entre em contato conosco atráves do e-mail ou atráves do Discord.');
    }
}
