var bigIMG = document.getElementById('big');
var subIMG = document.getElementById('sub').getElementsByTagName('img');

for (var i = 0; i < subIMG.length; i++) {
    subIMG[i].addEventListener('click', full_image);
}

function full_image() {
    var imgSrc = this.getAttribute('src');
    bigIMG.innerHTML = "<img src=" + imgSrc + ">";
}

function kosong() {
    $("#modalhabis").modal();
}

jQuery(document).ready(function () {
    $('#size').change(function () {
        var value = $(this).val();
        if (value == 'kosong') {
            $("#modalhabis").modal();
            document.getElementById("size").selectedIndex = "0";
        }
    });

    $('#beli').click(function () {
        var value = $('#size').val();
        if (value == 'kosong') {
            $("#modalpilih").modal();
            return false;
        }
    });
});
