function tambah(id) {
    var idrow = id;
    if (idrow) {
        jQuery.ajax({
            //  url: 'https://wisnusetyawann.xyz/cart/tambahbelanjaan/'+idrow,
            url: 'http://localhost:8000/cart/tambahbelanjaan/' + idrow,
            type: "GET",
            dataType: "json",
            beforeSend: function () {
                $('#loader').css("visibility", "visible");
            },

            success: function (data) {
                if (data["stokkurang"] != '1') {
                    $('select[name="ongkirservice"]').empty();
                    document.getElementById("jasa").selectedIndex = "0";

                    $('#ongkir').val("");
                    $('#ongkirtampil').html('0');

                    $('#kupon').val("");
                    $('#potongankupon').val("0");
                    $('#kupontampil').html('');

                    $('input[name="' + id + 'tempqty"]').val(data["jumlah"]);
                    $('#jumlahbelanjaan').html("Barang Belanjaan : " + data["jumlahbelanjaan"]);
                    $('#beratbelanjaan').html("Berat Belanjaan : " + (data["jumlahbelanjaan"] * 300) / 1000 + " Kg");

                    $('b[id="' + id + 'qty"]').html(data["jumlah"]);
                    $('b[id="' + id + 'tprice"]').html("Rp " + thousands_separators(data["subtotal"]));

                    $('#barang').val(data["total"]);
                    $('#berat').val(data["jumlahbelanjaan"] * 300)
                    $('#barangtampil').html("Rp " + thousands_separators(data["total"]));

                    var barang = data["total"].replace(/[^0-9]/g, ''); //subtotal barang
                    var ongkir = $('#ongkir').val().replace(/[^0-9]/g, ''); //ongkir
                    var barangnumber = +(barang.replace(/,/, '')); //convert ke number
                    var ongkirnumber = +(ongkir.replace(/,/, '')); //convert ke number

                    var kupon = $('#potongankupon').val().replace(/[^0-9]/g, '');
                    var kuponnumber = +(kupon.replace(/,/, '')); //convert ke number

                    var totalupdate = barangnumber + ongkirnumber;
                    $('#totaltampil').html('Rp ' + thousands_separators(totalupdate - kuponnumber));
                    $('#total').val(totalupdate);
                } else {
                    $("#warning").modal();
                    $('#warningtext').html("Maaf Stok Barang Tidak Mencukupi");
                }

            },
            complete: function () {
                $('#loader').css("visibility", "hidden");
            }
        });
    } else {
        $('select[name="cities"]').append('<option value="error"> error </option>');
    }
}

function kurang(id) {
    if ($('input[name="' + id + 'tempqty"]').val() > 1) {
        var idrow = id;
        if (idrow) {
            jQuery.ajax({
                //  url: 'https://wisnusetyawann.xyz/cart/kurangbelanjaan/'+idrow,
                url: 'http://localhost:8000/cart/kurangbelanjaan/' + idrow,
                type: "GET",
                dataType: "json",
                beforeSend: function () {
                    $('#loader').css("visibility", "visible");
                },

                success: function (data) {
                    $('select[name="ongkirservice"]').empty();
                    document.getElementById("jasa").selectedIndex = "0";

                    $('#ongkir').val("");
                    $('#ongkirtampil').html('0');

                    $('#kupon').val("");
                    $('#potongankupon').val("0");
                    $('#kupontampil').html('');

                    $('input[name="' + id + 'tempqty"]').val(data["jumlah"]);
                    $('#jumlahbelanjaan').html("Barang Belanjaan : " + data["jumlahbelanjaan"]);
                    $('#beratbelanjaan').html("Berat Belanjaan : " + (data["jumlahbelanjaan"] * 300) / 1000 + " Kg");

                    $('b[id="' + id + 'qty"]').html(data["jumlah"]);
                    $('b[id="' + id + 'tprice"]').html("Rp " + thousands_separators(data["subtotal"]));

                    $('#berat').val(data["jumlahbelanjaan"] * 300)
                    $('#barang').val(data["total"]);
                    $('#barangtampil').html("Rp " + thousands_separators(data["total"]));

                    var barang = data["total"].replace(/[^0-9]/g, ''); //subtotal barang
                    var ongkir = $('#ongkir').val().replace(/[^0-9]/g, ''); //ongkir
                    var barangnumber = +(barang.replace(/,/, '')); //convert ke number
                    var ongkirnumber = +(ongkir.replace(/,/, '')); //convert ke number

                    var kupon = $('#potongankupon').val().replace(/[^0-9]/g, '');
                    var kuponnumber = +(kupon.replace(/,/, '')); //convert ke number

                    var totalupdate = barangnumber + ongkirnumber;
                    $('#totaltampil').html('Rp ' + thousands_separators(totalupdate - kuponnumber));
                    $('#total').val(totalupdate);
                },
                complete: function () {
                    $('#loader').css("visibility", "hidden");
                }
            });
        } else {
            $('select[name="cities"]').append('<option value="error"> error </option>');
        }
    } else {
        $("#warning").modal();
        $('#warningtext').html("Pembelian Tidak Bisa Kurang Dari Satu");
    }
}

function thousands_separators(num) {
    var num_parts = num.toString().split(".");
    num_parts[0] = num_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    return num_parts.join(".");
}

$('#gagalbelanja').modal();

$('#kupon').change(function () {
    var kupon = $(this).val();
    var subtotal = $('#barang').val().replace(/[^0-9]/g, '');
    if (kupon) {
        jQuery.ajax({
            //  url: 'https://wisnusetyawann.xyz/cart/cekkupon/'+kupon,
            url: 'http://localhost:8000/cart/cekkupon/' + kupon + '/' + subtotal,
            type: "GET",
            dataType: "json",
            beforeSend: function () {
                $('#loader').css("visibility", "visible");
            },

            success: function (data) {
                if (data['info'] == 'ada') {
                    if (data['status'] == null) {
                        $('#kuponwarning').html("");
                        $('#kupontampil').html("Rp " + thousands_separators(data["potongan"]));
                        $('#potongankupon').val(data["potongan"]);

                        var total = $('#total').val().replace(/[^0-9]/g, '');
                        var totalnumber = +(total.replace(/,/, ''));

                        var totalupdate = totalnumber - data['potongan'];
                        $('#totaltampil').html('Rp ' + thousands_separators(totalupdate));
                    } else {
                        var total = $('#total').val()
                        $('#totaltampil').html('Rp ' + thousands_separators(total));
                        $('#kupon').val("");
                        $('#kupontampil').html("0");
                        $('#kuponwarning').html(data['status']);
                        $('#kupontampil').html(data['status']);
                    }
                } else if (data['info'] == 'tidakada') {
                    var total = $('#total').val()
                    $('#totaltampil').html('Rp ' + thousands_separators(total));
                    $('#kupon').val("");
                    $('#kupontampil').html("0");
                    $('#kuponwarning').html("Kode Kupon Tidak Ditemukan" + data['1']);
                }
            },
            complete: function () {
                $('#loader').css("visibility", "hidden");
            }
        });
    } else {
        $('#kuponwarning').html("kupon tidak ada");
    }
});
