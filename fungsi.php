<?php

function kalkulator_kredit() {
    wp_enqueue_style('cssbootstrap');
    wp_enqueue_script('jsbootstrap');
    wp_enqueue_script('jsnumeral');
    wp_enqueue_script('jscurformatter');

    wp_enqueue_style('stylekredit');
    wp_enqueue_script('scriptkredit');
 
    echo '
    <div class="box-live-kalkulator">
        <div class="row">
            <div class="col-md-7 live-form">
                <form id="live-calc-kredit" class="form-horizontal">
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Jumlah Pinjaman</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <input type="text" class="form-control" id="live-jumlah-pinjaman" name="jumlah-pinjaman" placeholder="Jumlah Pinjaman" value="10000000">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Perhitungan Bunga</label>
                        <div class="col-sm-8">
                            <select id="live-perhitungan-bunga" name="perhitungan-bunga" class="form-control">
                                <option value="anuitas" selected="selected">Anuitas (Angsuran Tetap)</option>
                                <option value="efektif">Efektif (Angsuran Menurun)</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Jangka Waktu</label>
                        <div class="col-sm-8">
                            <select id="live-jangka-waktu" name="jangka-waktu" class="form-control">
                                <option value="12">1 Tahun</option>
                                <option value="24">2 Tahun</option>
                                <option value="36">3 Tahun</option>
                                <option value="48">4 Tahun</option>
                                <option value="60">5 Tahun</option>
                                <option value="72">6 Tahun</option>
                                <option value="84">7 Tahun</option>
                                <option value="96">8 Tahun</option>
                                <option value="108">9 Tahun</option>
                                <option value="120">10 Tahun</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Suku Bunga</label>
                        <div class="col-sm-8">
                            <div class="live-sukubunga-wrapper">
                                <div class="input-group">
                                    <input type="number" class="form-control" id="live-suku-bunga" name="suku-bunga" placeholder="" value="1.75" min="1" step="0.05" max="5">
                                    <div class="input-group-addon"> %/bulan </div>
                                </div>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="live-suku-bunga-tahun" name="suku-bunga-tahun" placeholder="" value="21" readonly="">
                                    <div class="input-group-addon">%/tahun</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-5 live-calculate">
                <h3 class="simulasi-cicilan-title">Simulasi Cicilan<br>per bulan<span>*</span></h3>
                <h3 class="hasil-simulasi-cicilan" id="hasil-simulasi-cicilan"></h3>
                <p><a href="/form-permohonan-kredit/">Ajukan Sekarang <i class="fa fa-angle-right" aria-hidden="true"></i></a></p>
                <p><a id="live-simulasi-lengkap-page" href="javascript:void(0)">Lihat Simulasi Lengkap <i class="fa fa-angle-right" aria-hidden="true"></i></a></p>
                <p class="live-calc-note-mobile">*) Simulasi cicilan di atas hanya perkiraan.</p>
            </div>
        </div>
    </div>
    <div id="print-live-kalkulasi-kredit" style="display: none;">
    <br>
    <hr>
    <br>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover table-data-simulasi">
                <tbody>
                    <tr><th colspan="2" class="modal-thema text-center">DATA ANDA</th></tr>
                    <tr>
                        <th width="50%">Pinjaman</th>
                        <th id="data-pinjaman"></th>
                    </tr>
                    <tr>
                        <th width="50%">Perhitungan Bunga</th>
                        <th id="data-jenis"></th>
                    </tr>
                    <tr>
                        <th width="50%" valign="top" style="vertical-align: top">Suku Bunga</th>
                        <th id="data-bunga">1.75% per bulan</th>
                    </tr>
                    <tr>
                        <th width="50%" valign="top" style="vertical-align: top">Jangka Waktu</th>
                        <th id="data-durasi"></th>
                    </tr>
                    <!-- <tr>
                        <th width="50%" valign="top" style="vertical-align: top">Mulai Meminjam</th>
                        <th>Okt 2020</th>
                    </tr> -->
                </tbody>
            </table>
        </div>
        <div style="width: 100%; height: 15px;"></div>
        <div class="table-responsive table-bpr">
            <table class="table table-bordered table-striped table-hover table-data-simulasi">
                <thead>
                    <tr><th colspan="2" class="text-center modal-thema">ANGSURAN ANDA</th></tr>
                    <tr>
                        <th width="50%">Angsuran per Bulan</th>
                        <th id="angsuran-info">Rp. 931.138</th>
                    </tr>
                </thead>
            </table>
        </div>
        <div style="width: 100%; height: 15px;"></div>
        <div class="table-responsive table-bpr">
            <table class="table table-bordered table-striped table-hover" style="margin-bottom: 0">
                <thead>
                    <tr>
                        <th width="200" class="text-center bprsk-blue-bg">Periode</th>
                        <!-- <th class="bprsk-blue-bg">Pokok Pinjaman</th> -->
                        <th width="200" class="text-center bprsk-blue-bg">Angs. Bunga</th>
                        <th width="200" class="text-center bprsk-blue-bg">Angs. Pokok</th>
                        <th width="200" class="text-center bprsk-blue-bg">Total Angsuran</th>
                        <th width="200" class="text-center bprsk-blue-bg">Sisa Pinjaman</th>
                    </tr>
                </thead>
                <tbody id="tabel-anuitas">                                            
                <input id="angsuran-view" type="hidden" name="angsuran-view" value="Rp. 931.138">
                <input id="jumlahbunga-view" type="hidden" name="jumlahbunga-view" value="Rp. 1.173.653">
                </tbody>
            </table>
        </div>
    </div>
    <script>
        jQuery(document).ready(function() {
            var format = new curFormatter();
            
            format.input("#live-jumlah-pinjaman");
            bungaTahun();
            hitungPinjaman();
        });
    </script>
    ';

}

add_shortcode('kalkulator_kredit','kalkulator_kredit');

function kalkulator_depan() {
    wp_enqueue_style('cssbootstrap');
    wp_enqueue_script('jsbootstrap');
    wp_enqueue_script('jsnumeral');
    wp_enqueue_script('jscurformatter');

    wp_enqueue_style('stylekredit');
    wp_enqueue_script('scriptkredit');
    echo '
    <div class="box-live-kalkulator">
        <div class="row">
            <div class="col-md-7 live-form">
                <form id="live-calc-kredit" class="form-horizontal">
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Jumlah Pinjaman</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <input type="text" class="form-control" id="live-jumlah-pinjaman" name="jumlah-pinjaman" placeholder="Jumlah Pinjaman" value="10000000">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Perhitungan Bunga</label>
                        <div class="col-sm-8">
                            <select id="live-perhitungan-bunga" name="perhitungan-bunga" class="form-control">
                                <option value="anuitas" selected="selected">Anuitas (Angsuran Tetap)</option>
                                <option value="efektif">Efektif (Angsuran Menurun)</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Jangka Waktu</label>
                        <div class="col-sm-8">
                            <select id="live-jangka-waktu" name="jangka-waktu" class="form-control">
                                <option value="12">1 Tahun</option>
                                <option value="24">2 Tahun</option>
                                <option value="36">3 Tahun</option>
                                <option value="48">4 Tahun</option>
                                <option value="60">5 Tahun</option>
                                <option value="72">6 Tahun</option>
                                <option value="84">7 Tahun</option>
                                <option value="96">8 Tahun</option>
                                <option value="108">9 Tahun</option>
                                <option value="120">10 Tahun</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Suku Bunga</label>
                        <div class="col-sm-8">
                            <div class="live-sukubunga-wrapper">
                                <div class="input-group">
                                    <input type="number" class="form-control" id="live-suku-bunga" name="suku-bunga" placeholder="" value="1.75" min="1" step="0.05" max="5">
                                    <div class="input-group-addon"> %/bulan </div>
                                </div>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="live-suku-bunga-tahun" name="suku-bunga-tahun" placeholder="" value="21" readonly="">
                                    <div class="input-group-addon">%/tahun</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-5 live-calculate">
                <h3 class="simulasi-cicilan-title">Simulasi Cicilan<br>per bulan<span>*</span></h3>
                <h3 class="hasil-simulasi-cicilan" id="hasil-simulasi-cicilan"></h3>
                <p><a href="/form-permohonan-kredit/">Ajukan Sekarang <i class="fa fa-angle-right" aria-hidden="true"></i></a></p>
                <p><a id="live-simulasi-lengkap-modal" href="javascript:void(0)">Lihat Simulasi Lengkap <i class="fa fa-angle-right" aria-hidden="true"></i></a></p>
                <p class="live-calc-note-mobile">*) Simulasi cicilan di atas hanya perkiraan.</p>
            </div>
        </div>
    </div>
    <div id="modal-home-live-kalkulasi-kredit" class="modal-live-kalkulator modal fade" tabindex="-1" role="dialog" style="display: none;">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">SIMULASI KREDIT</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div id="print-live-kalkulasi-kredit" class="modal-body" style="padding: 0">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover table-data-simulasi">
                            <tbody>
                                <tr><th colspan="2" class="modal-thema text-center">DATA ANDA</th></tr>
                                <tr>
                                    <th width="50%">Pinjaman</th>
                                    <th id="data-pinjaman"></th>
                                </tr>
                                <tr>
                                    <th width="50%">Perhitungan Bunga</th>
                                    <th id="data-jenis"></th>
                                </tr>
                                <tr>
                                    <th width="50%" valign="top" style="vertical-align: top">Suku Bunga</th>
                                    <th id="data-bunga">1.75% per bulan</th>
                                </tr>
                                <tr>
                                    <th width="50%" valign="top" style="vertical-align: top">Jangka Waktu</th>
                                    <th id="data-durasi"></th>
                                </tr>
                                <!-- <tr>
                                    <th width="50%" valign="top" style="vertical-align: top">Mulai Meminjam</th>
                                    <th>Okt 2020</th>
                                </tr> -->
                            </tbody>
                        </table>
                    </div>
                    <div style="width: 100%; height: 15px;"></div>
                    <div class="table-responsive table-bpr">
                        <table class="table table-bordered table-striped table-hover table-data-simulasi">
                            <thead>
                                <tr><th colspan="2" class="text-center modal-thema">ANGSURAN ANDA</th></tr>
                                <tr>
                                    <th width="50%">Angsuran per Bulan</th>
                                    <th id="angsuran-info">Rp. 931.138</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div style="width: 100%; height: 15px;"></div>
                    <div class="table-responsive table-bpr">
                        <table class="table table-bordered table-striped table-hover" style="margin-bottom: 0">
                            <thead>
                                <tr>
                                    <th width="200" class="text-center bprsk-blue-bg">Periode</th>
                                    <!-- <th class="bprsk-blue-bg">Pokok Pinjaman</th> -->
                                    <th width="200" class="text-center bprsk-blue-bg">Angs. Bunga</th>
                                    <th width="200" class="text-center bprsk-blue-bg">Angs. Pokok</th>
                                    <th width="200" class="text-center bprsk-blue-bg">Total Angsuran</th>
                                    <th width="200" class="text-center bprsk-blue-bg">Sisa Pinjaman</th>
                                </tr>
                            </thead>
                            <tbody id="tabel-anuitas">                                            
                            <input id="angsuran-view" type="hidden" name="angsuran-view" value="Rp. 931.138">
                            <input id="jumlahbunga-view" type="hidden" name="jumlahbunga-view" value="Rp. 1.173.653">
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-md-6 text-left">
                            <a href="/form-permohonan-kredit/" class="btn btn-theme-bg btn-ajukan-sekarang-modal">AJUKAN SEKARANG</a>
                        </div>
                        <div class="col-md-6 modal-ajukan-sekarang-tombol">
                            <button id="button-print-box-kalkulasi-kredit" type="button" class="btn btn-primary">CETAK</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        jQuery(document).ready(function() {
            var format = new curFormatter();
            
            format.input("#live-jumlah-pinjaman");
            bungaTahun();
            hitungPinjaman();
        });
    </script>
    ';
}

add_shortcode('kalkulator_depan','kalkulator_depan');