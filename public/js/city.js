jQuery(document).ready(function () {

    jQuery('select[name="prov"]').on('change', function () {
        $('select[name="ongkirservice"]').empty();
        document.getElementById("jasa").selectedIndex = "0";
        var ongkir = $('#ongkir').val().replace(/[^0-9]/g, '');
        var ongkirnumber = +(ongkir.replace(/,/, ''));
        var total = $('#total').val().replace(/[^0-9]/g, '');
        var totalnumber = +(total.replace(/,/, ''));
        var total = totalnumber - ongkirnumber;
        $('#ongkir').val("");
        $('#total').val(total)

        var kupon = $('#potongankupon').val().replace(/[^0-9]/g, '');
        var kuponnumber = +(kupon.replace(/,/, '')); //convert ke number

        $('#ongkirtampil').html('Rp ' + thousands_separators("0"));
        $('#totaltampil').html('Rp ' + thousands_separators(total - kuponnumber));

        var provId = $(this).val();
        if (provId) {
            jQuery.ajax({
                //  url: 'https://wisnusetyawann.xyz/cart/city/'+provId,
                url: 'http://localhost:8000/cart/city/' + provId,
                type: "GET",
                dataType: "json",
                beforeSend: function () {
                    $('#loader').css("visibility", "visible");
                },

                success: function (data) {
                    $('select[name="cities"]').empty();
                    $('select[name="ongkirservice"]').empty();
                    document.getElementById("jasa").selectedIndex = "0";
                    $.each(data, function (id, name) {
                        $('select[name="cities"]').append('<option value="' + id + '">' + name + '</option>');
                    });
                },
                complete: function () {
                    $('#loader').css("visibility", "hidden");
                }
            });
        } else {
            $('select[name="cities"]').append('<option value="error"> error </option>');
        }
    });

    jQuery('select[name="cities"]').on('change', function () {
        $('select[name="ongkirservice"]').empty();
        document.getElementById("jasa").selectedIndex = "0";
        var ongkir = $('#ongkir').val().replace(/[^0-9]/g, '');
        var ongkirnumber = +(ongkir.replace(/,/, ''));
        var total = $('#total').val().replace(/[^0-9]/g, '');
        var totalnumber = +(total.replace(/,/, ''));
        var total = totalnumber - ongkirnumber;
        $('#ongkir').val("");
        $('#total').val(total)

        var kupon = $('#potongankupon').val().replace(/[^0-9]/g, '');
        var kuponnumber = +(kupon.replace(/,/, '')); //convert ke number

        $('#ongkirtampil').html('Rp ' + thousands_separators("0"));
        $('#totaltampil').html('Rp ' + thousands_separators(total - kuponnumber));
    });

    jQuery('select[name="jasa"]').on('change', function (e) {
        var ongkir = $('#ongkir').val().replace(/[^0-9]/g, '');
        var ongkirnumber = +(ongkir.replace(/,/, ''));
        var total = $('#total').val().replace(/[^0-9]/g, '');
        var totalnumber = +(total.replace(/,/, ''));
        var total = totalnumber - ongkirnumber;
        $('#ongkir').val("");
        $('#total').val(total)

        var kupon = $('#potongankupon').val().replace(/[^0-9]/g, '');
        var kuponnumber = +(kupon.replace(/,/, '')); //convert ke number

        $('#ongkirtampil').html('Rp ' + thousands_separators("0"));
        $('#totaltampil').html('Rp ' + thousands_separators(total - kuponnumber));

        var asal = 419;
        var kab = $('#cities').val();
        var kurir = $(this).val().toLowerCase();
        var berat = $('#berat').val();

        jQuery.ajax({
            url: 'http://localhost:8000/cart/cekongkir2/' + asal + '/' + kab + '/' + berat + '/' + kurir,
            // url: 'https://www.wisnusetyawann.xyz/cart/cekongkir2/'+asal+'/'+kab+'/'+berat+'/'+kurir,
            type: "GET",
            dataType: "json",
            beforeSend: function () {
                $('#loader').css("visibility", "visible");
            },

            success: function (data) {
                $('select[name="ongkirservice"]').empty();
                if (!data) {
                    $('select[name="jasa"]').empty();
                    $('select[name="ongkirservice"]').empty();
                    $('select[name="ongkirservice"]').append('<option selected value="' + 'PromoOngkir' + 10000 + '">' + 'Promo Ongkir - Rp ' + 10000 + '</option>');
                    $('select[name="jasa"]').append('<option selected value="PromoOngkir">PromoOngkir</option>');
                    var total = $('input[name="total"]').val().replace(/[^0-9]/g, ',');
                    var bil1 = +(total.replace(/,/, ','));
                    $('b[id="ongkir1"]').html(10000);
                    $('b[id="subtotal"]').html(bil1 + 10000);
                    $('input[name="harga"]').val(10000);
                    $('input[name="subtotal"]').val(bil1 + 10000);
                } else {
                    $('select[name="ongkirservice"]').append('<option selected value="">Pilih Service</option>');
                    for (var i in data.rajaongkir.results[0].costs) {
                        $('select[name="ongkirservice"]').append('<option value="' +
                            data.rajaongkir.results[0].costs[i].service +
                            data.rajaongkir.results[0].costs[i].cost[0].value + '">' +
                            data.rajaongkir.results[0].costs[i].service + ' - Rp ' +
                            data.rajaongkir.results[0].costs[i].cost[0].value + ' - Estimasti ' +
                            data.rajaongkir.results[0].costs[i].cost[0].etd + ' Hari </option>');
                    }
                }
            },
            complete: function () {
                $('#loader').css("visibility", "hidden");
            }
        });

    });

    $('select[name="ongkirservice"]').on('click', function () {
        var barang = $('#barang').val().replace(/[^0-9]/g, '');
        var ongkir = $(this).val().replace(/[^0-9]/g, '');
        var ongkirnumber = +(ongkir.replace(/,/, ''));
        var barangnumber = +(barang.replace(/,/, ''));
        var total = barangnumber + ongkirnumber;


        var kupon = $('#potongankupon').val().replace(/[^0-9]/g, '');
        var kuponnumber = +(kupon.replace(/,/, '')); //convert ke number

        $('#ongkirtampil').html('Rp ' + thousands_separators(ongkirnumber));
        $('#totaltampil').html('Rp ' + thousands_separators(total - kuponnumber));
        $('#ongkir').val(ongkirnumber);
        $('#total').val(total);


    });

});

function alamat(id) {
    $('select[name="ongkirservice"]').empty();
    document.getElementById("jasa").selectedIndex = "0";
    var ongkir = $('#ongkir').val().replace(/[^0-9]/g, '');
    var ongkirnumber = +(ongkir.replace(/,/, ''));
    var total = $('#total').val().replace(/[^0-9]/g, '');
    var totalnumber = +(total.replace(/,/, ''));
    var total = totalnumber - ongkirnumber;
    $('#ongkir').val("");
    $('#total').val(total)

    var kupon = $('#potongankupon').val().replace(/[^0-9]/g, '');
    var kuponnumber = +(kupon.replace(/,/, '')); //convert ke number

    $('#ongkirtampil').html('Rp ' + thousands_separators("0"));
    $('#totaltampil').html('Rp ' + thousands_separators(total - kuponnumber));
    $('input[name="idalamat"]').val($('#' + id + 'did').val());
    $('input[name="nama"]').val($('#' + id + 'dnama').val());
    $('input[name="telp"]').val($('#' + id + 'dtelp').val());
    $('textarea[name="alamat"]').val($('#' + id + 'djalan').val());
    $('input[name="kode_pos"]').val($('#' + id + 'dkode').val());
    $('select[name="prov"]').append('<option selected value="' + $('#' + id + 'dprovid').val() + '">' + $('#' + id + 'dprov').val() + ' </option>');
    $('select[name="cities"]').append('<option selected value="' + $('#' + id + 'dkotaid').val() + '">' + $('#' + id + 'dkota').val() + ' </option>');
}
