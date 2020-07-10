if (window.location.hostname === "www.vemsimplificar.com.br") {
	let folder = "";
	
	CKEDITOR.replace('content_question', {
    language: "pt-br",
	
    });
} else {
	let folder = "/vemsimplificar";

	CKEDITOR.replace('content_question', {
    language: "pt-br",
	});
}

if (window.location.hostname === "www.vemsimplificar.com.br") {
	let folder = "";
	
	CKEDITOR.replace('resolution_question', {
    language: "pt-br",
	
    });
} else {
	let folder = "/vemsimplificar";

	CKEDITOR.replace('resolution_question', {
    language: "pt-br",
	});
}

