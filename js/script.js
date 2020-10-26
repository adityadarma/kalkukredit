var format = new curFormatter();

jQuery('#live-perhitungan-bunga, #live-jangka-waktu').on('change', function(){
    hitungPinjaman();
});
jQuery('#live-jumlah-pinjaman, #live-suku-bunga').on('keyup', function(){
    hitungPinjaman();
});
jQuery('#live-suku-bunga').on('click', function(){
    hitungPinjaman();
});

function hitungPinjaman(){
    let pinjaman = format.unformat(jQuery('#live-jumlah-pinjaman').val());
    let bunga = jQuery('#live-suku-bunga').val().replace(',','.');
    let durasi = jQuery('#live-jangka-waktu').val();
    let jenis = jQuery('#live-perhitungan-bunga').val();

    if(jenis == 'anuitas')
    {
        jQuery('#hasil-simulasi-cicilan').text('Rp. '+format.format(hitungAnu(pinjaman, bunga, durasi))+',-');
    }
    else if(jenis == 'efektif')
    {
        jQuery('#hasil-simulasi-cicilan').text('Rp. '+format.format(hitungEfe(pinjaman, bunga, durasi))+',-');
    }   
}

jQuery('#live-simulasi-lengkap').click(function(){
    let pinjaman = format.unformat(jQuery('#live-jumlah-pinjaman').val());
    let bunga = jQuery('#live-suku-bunga').val().replace(',','.');
    let durasi = jQuery('#live-jangka-waktu').val();
    let jenis = jQuery('#live-perhitungan-bunga').val();

    if(jenis == 'anuitas')
    {
        var angsuran_perbulan = hitungAnu(pinjaman, bunga, durasi);
        var sisa_pinjaman = pinjaman;
        var html = '';
        for (let index = 1; index <= durasi; index++) {
            let angsuran_bunga = sisa_pinjaman * (parseFloat(bunga) / 100);
            sisa_pinjaman = sisa_pinjaman - (angsuran_perbulan-angsuran_bunga);
            html += '<tr>'+
                        '<td class="text-center">'+index+'</td>'+
                        '<td class="text-center">Rp. '+format.format(angsuran_perbulan-angsuran_bunga)+'</td>'+
                        '<td class="text-center">Rp. '+format.format(angsuran_bunga)+'</td>'+
                        '<td class="text-center">Rp. '+format.format(angsuran_perbulan)+'</td>'+
                        '<td class="text-center">Rp. '+format.format(sisa_pinjaman)+'</td>'+
                    '</tr>'
        }


        jQuery('#tabel-anuitas').html(html);
        jQuery('#data-jenis').text('Anuitas');
        jQuery('#angsuran-info').text('Rp. '+format.format(angsuran_perbulan));
    }
    else if(jenis == 'efektif')
    {
        jQuery('#data-jenis').text('Efektif');
        jQuery('#angsuran-info').text('Rp. '+format.format(hitungEfe(pinjaman, bunga, durasi)));
    }
    jQuery('#data-pinjaman').text('Rp. '+jQuery('#live-jumlah-pinjaman').val());
    jQuery('#data-bunga').text(jQuery('#live-suku-bunga').val()+'%');
    jQuery('#data-durasi').text(jQuery('#live-jangka-waktu').val()+' bulan');





    jQuery('#modal-home-live-kalkulasi-kredit').modal('show');
    console.log('kluar modal');
});

function hitungAnu(pinjaman, bunga, durasi) {
    return pinjaman * (((bunga/100) * Math.pow((1 + (bunga/100)) , durasi)) / (Math.pow(1 + (bunga/100) , durasi) - 1));
}

function hitungEfe(pinjaman, bunga, durasi) {
    return ( pinjaman / durasi) + (pinjaman * (parseFloat(bunga) / 100));
}