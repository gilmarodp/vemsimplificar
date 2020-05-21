const URLPAGE = "https://www.vemsimplificar.com.br";
function validateQuestion(id1, id2) {
    var content1 = document.getElementById(id1).textContent;
    var content2 = document.getElementById(id2).textContent;

    if (content1 === "" || content2 === "") {
        window.alert('A resolução dessa questão ainda não está pronto, se tiver dúvidas, entre em contato conosco atráves do e-mail ou atráves do Discord.');
        location.href = URLPAGE + "/ooops/404";
    }
}