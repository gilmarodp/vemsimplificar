const URLPAGE = "http://http://192.168.0.199/mundo_comentado/";
function validate(id1, id2) {
    var content1 = document.getElementById(id1).textContent;
    var content2 = document.getElementById(id2).textContent;

    if (content1 === "" || content2 === "") {
        location.href = URLPAGE + "ooops/404";
    }
}