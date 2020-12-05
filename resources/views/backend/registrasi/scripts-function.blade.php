<script type="text/javascript">
    function loadModal() {
        $('#form-skdp').hide();
        $('#form-katarak').hide();
        $("#form-penjamin-kll").hide();
        $('#form-asal-pasien').hide();

        $('#no-reg').val("")
        $('#no-rm').val("")
        $('#no-kartu').val("")
        $('#no-telp').val("")
        $('#nama-pasien').val("")
        $('#no-ktp').val("")
        $('#tgl-lahir').val("")
        $('#alamat').val("")
        $('#jns-pelayanan').val("")

        $('#no-surat').val("000000")
        $('#no-surat-lama').val("000000")
        $('#kode-dpjp').val("000000")
        $('#propinsi').val("0")
        $('#keterangan').val("0")
        $('#provinsi').prop('selectedIndex',0);
        $('#kabupaten option').prop('selected', function() {
            return this.defaultSelected;
        });
        $('#kecamatan option').prop('selected', function() {
            return this.defaultSelected;
        });
        var form = $('#form-sep');
        // Reset validationo error
        form.find('.invalid-feedback').remove();
        form.find('input').removeClass('is-invalid');
        form.find('textarea').removeClass('is-invalid');
      
    }
</script>