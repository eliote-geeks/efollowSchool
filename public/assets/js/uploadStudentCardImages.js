function previewLogoCreate(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
        document.getElementById("logoCreate").src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
}


function previewRectoCreate(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
        document.getElementById("rectoCreate").src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
}


function previewVersoCreate(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
        document.getElementById("versoCreate").src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function previewLogoEdit(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
        document.getElementById("logoEdit").src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
}


function previewRectoEdit(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
        document.getElementById("rectoEdit").src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function previewVersoEdit(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
        document.getElementById("versoEdit").src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
}
