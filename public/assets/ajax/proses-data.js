
$(document).ready(function() {
    $("form").on("input", '.16-length', function(){
        if (this.value.length > 16) {
            this.value = this.value.slice(0, 16); // Batas panjang maksimum 10 digit
        }
    });

    $("form").on("input", '.10-length', function(){
        if (this.value.length > 10) {
            this.value = this.value.slice(0, 10); // Batas panjang maksimum 10 digit
        }
    });

    // proses tambah akun
    $("#tambah-akun").on('click', '.simpan', function(){
        let data = $('#tambah-akun').serialize();

        $.ajax({
            url: 'tambah_akun',
            data: data,
            method: "POST",
            success:function(response)
            {
                $("#tambah").modal('hide');
                $(".messages").show();
                $('.messages').addClass('alert alert-success bg-success text-white').text(response.message).show();
                $('.messages').fadeIn().delay(3000).fadeOut(function() {
                    $(this).removeClass('alert-success bg-success');
                });
                account.ajax.reload();
                $("#tambah-akun")[0].reset();
            }
        });
    });

    // ambil data untuk di tampilkan di form ubah akun admin
    $('.account').on('click', '.ubah', function(){
        let id = $(this).data('id');

        $.ajax({
            url: "get_users_edit/"+id,
            method: "GET",
            success:function(response)
            {
                $('#ubah').modal('show');
                $("#ubah-akun").html(response);
            }
        });
    });

    // proses ubah data akun admin
    $('#ubah-akun').on('click', '.simpan', function(){
        let data = $('#ubah-akun').serialize();
        let id = $('#id').val();

        $.ajax({
            url: 'ubah_akun/'+id,
            data: data,
            method: "PUT",
            success:function(response)
            {
                $("#ubah").modal('hide');
                $(".messages").show();
                $('.messages').addClass('alert alert-success bg-success text-white').text(response.message).show();
                $('.messages').fadeIn().delay(3000).fadeOut(function() {
                    $(this).removeClass('alert-success bg-success');
                });
                account.ajax.reload();
            }
        });
    });

    // ambil data untuk di tampilkan di form konfirmasi hapus akun admin
    $('.account').on('click', '.hapus', function(){
        let id = $(this).data('id');

        $.ajax({
            url: "get_users_delete/"+id,
            method: "GET",
            success:function(response)
            {
                $("#hapus").modal("show");
                $("#hapus-akun").html(response);
            }
        });
    });

    // proses hapus data akun admin
    $("#hapus-akun").on("click", ".yes", function(){
        let id = $('#id').val();

        $.ajax({
            url: 'hapus_akun/'+id,
            method: "GET",
            success:function(response)
            {
                $("#hapus").modal('hide');
                $(".messages").show();
                $('.messages').addClass('alert alert-success bg-success text-white').text(response.message).show();
                $('.messages').fadeIn().delay(3000).fadeOut(function() {
                    $(this).removeClass('alert-success bg-success');
                });
                account.ajax.reload();
            }
        })
    });

    // proses tambah data guru
    $("#tambah-guru").on('click', '.simpan', function(){
        let data = $('#tambah-guru').serialize();

        $.ajax({
            url: "tambah_guru",
            method: 'POST',
            data: data,
            success:function(response)
            {
                $("#tambah").modal('hide');
                $(".messages").show();
                $('.messages').addClass('alert alert-success bg-success text-white').text(response.message).show();
                $('.messages').fadeIn().delay(3000).fadeOut(function() {
                    $(this).removeClass('alert-success bg-success');
                });
                data_guru.ajax.reload();
                $('#tambah-guru')[0].reset();
            }
        })
    });

    // ambil semua data guru untuk di tampilkan pada form edit guru
    $('.teacher').on('click', '.ubah', function(){
        let id = $(this).data('id');

        $.ajax({
            url: 'get_teacher_edit/'+id,
            method: "GET",
            success:function(response)
            {
                $('#ubah').modal('show');
                $("#ubah-guru").html(response);
            }
        });
    });

    // proses ubah data guru
    $("#ubah-guru").on('click', '.simpan', function(){
        let data = $('#ubah-guru').serialize();
        let id = $('#id').val();
        $.ajax({
            url: "ubah_guru/"+ id,
            method: "PUT",
            data: data,
            success:function(response)
            {
                $('#ubah').modal('hide');
                $(".messages").show();
                $('.messages').addClass('alert alert-success bg-success text-white').text(response.message).show();
                $('.messages').fadeIn().delay(3000).fadeOut(function() {
                    $(this).removeClass('alert-success bg-success');
                });
                data_guru.ajax.reload();
            }
        });
    });

    // ambil data guru untuk ditampilkan kedalam form konfirmasi hapus data
    $('.teacher').on('click', '.hapus', function(){
        let id = $(this).data('id');

        $.ajax({
            url: "get_teacher_delete/"+id,
            method: "GET",
            success: function(response)
            {
                $('#hapus').modal('show');
                $('#hapus-guru').html(response);
            }
        });
    });

    // proses hapus data guru
    $('#hapus-guru').on('click', '.yes', function(){
        let id = $('#id').val();

        $.ajax({
            url: "hapus_guru/"+id,
            method: "GET",
            success: function(response)
            {
                $("#hapus").modal('hide');
                $(".messages").show();
                $('.messages').addClass('alert alert-success bg-success text-white').text(response.message).show();
                $('.messages').fadeIn().delay(3000).fadeOut(function() {
                    $(this).removeClass('alert-success bg-success');
                });
                data_guru.ajax.reload();
            }
        })
    });

    $("#import-guru").on('click', '.import', function(){
        let file = $('#import-guru')[0];
        let data = new FormData(file);

        $.ajax({
            url: "import-guru",
            data: data,
            processData: false,
            contentType: false,
            method: "POST",
            success:function(response)
            {
                $("#import").modal('hide');
                $('.messages').show();
                // Remove any existing alert classes
                $('.messages').removeClass('alert-success bg-success alert-danger bg-danger text-white').empty();
                // Show error message
                $('.messages').addClass('alert alert-success bg-success text-white').text(response.message).show();
                $('html, body').animate({ scrollTop: 0 }, 'fast');
                setTimeout(function() {
                    $('.messages').fadeOut(function() {
                        $(this).empty().removeClass('alert alert-success bg-success text-white').hide();
                    });
                }, 3000);
                data_guru.ajax.reload();
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.error;
                    let errorMessages = '';

                    $.each(errors, function(key, messages) {
                        $.each(messages, function(index, message) {
                            errorMessages += message + '<br>';
                        });
                    });
                    console.log(errorMessages);
                    $("#error-message").show();
                    $('#error-message').addClass('alert alert-danger bg-danger text-white').html(errorMessages).show();
                    $('#error-message').fadeIn().delay(3000).fadeOut(function() {
                        $(this).empty();
                    });
                }
            }
        });
    });

    // proses tambah data siswa
    $("#tambah-siswa").on('click', '.simpan', function(){
        let data = $('#tambah-siswa').serialize();

        $.ajax({
            url: "tambah_siswa",
            data: data,
            method: "POST",
            success:function(response)
            {
                $("#tambah").modal('hide');
                $(".messages").show();
                $('.messages').addClass('alert alert-success bg-success text-white').text(response.message).show();
                $('.messages').fadeIn().delay(3000).fadeOut(function() {
                    $(this).removeClass('alert-success bg-success');
                });
                data_siswa.ajax.reload();
                $('#tambah-siswa')[0].reset();
            }
        });
    });

    // proses pengambilan data siswa dari database untuk di tampilkan di form ubah data siswa
    $(".student").on('click', '.ubah', function(){
        let id = $(this).data('id');

        $.ajax({
            url: "get_siswa/"+id,
            method: "GET",
            success:function(response)
            {
                $("#ubah").modal('show');
                $('#ubah-siswa #id').val(id);
                $('#ubah-siswa input[name=nisn]').val(response.siswa.nisn);
                $('#ubah-siswa input[name=nik]').val(response.siswa.nik);
                $('#ubah-siswa input[name=nama]').val(response.personal_data.nama);
                if(response.personal_data.jenis_kelamin == "L")
                {
                    $('#ubah-siswa input[value=L]').prop('checked', true);
                }
                else if(response.personal_data.jenis_kelamin == "P")
                {
                    $('#ubah-siswa input[value=P]').prop('checked', true);
                }
                $('#ubah-siswa input[name=t_lhr]').val(response.siswa.tempat_lahir);
                $('#ubah-siswa input[name=tgl_lhr]').val(response.siswa.tanggal_lahir);
                $('#ubah-siswa textarea[name=alamat]').html(response.personal_data.alamat);
                $('#ubah-siswa input[name=rt]').val(response.siswa.rt);
                $('#ubah-siswa input[name=rw]').val(response.siswa.rw);
                $('#ubah-siswa input[name=kelurahan]').val(response.siswa.kelurahan);
                $('#ubah-siswa input[name=kecamatan]').val(response.siswa.kecamatan);
                $('#ubah-siswa input[name=kode_pos]').val(response.siswa.kode_pos);
                $('#ubah-siswa input[name=anak_ke]').val(response.siswa.anak_ke);
                $('#ubah-siswa input[name=nama_ayah]').val(response.siswa.nama_ayah);
                $('#ubah-siswa input[name=nama_ibu]').val(response.siswa.nama_ibu);
                select_agama(response.siswa.agama);
                select_tingkat(response.siswa.tingkat);
                select_pekerjaan_ayah(response.siswa.pekerjaan_ayah);
                select_pendidikan_ayah(response.siswa.pendidikan_ayah);
                select_pekerjaan_ibu(response.siswa.pekerjaan_ibu);
                select_pendidikan_ibu(response.siswa.pendidikan_ibu);
            }
        })
    });

    // proses ubah data siswa
    $("#ubah-siswa").on('click', '.simpan', function(){
        let data = $('#ubah-siswa').serialize();
        let id = $('#id').val();

        $.ajax({
            url: "ubah_siswa/"+id,
            method: "PUT",
            data: data,
            success:function(response)
            {
                $("#ubah").modal('hide');
                $(".messages").show();
                $('.messages').addClass('alert alert-success bg-success text-white').text(response.message).show();
                $('.messages').fadeIn().delay(3000).fadeOut(function() {
                    $(this).removeClass('alert-success bg-success');
                });
                data_siswa.ajax.reload();
            }
        });
    });

    // konfirmasi hapus data
    $(".student").on('click', '.hapus', function(){
        let id = $(this).data('id');
        let nama = $(this).attr('id');
        $("#nama-siswa").text(nama);
        $('#id-siswa').val(id);
        $('#hapus').modal('show');
    });

    // proses hapus data siswa
    $('#hapus-siswa').on("click", '.yes', function() {
        let id = $('#id-siswa').val();

        $.ajax({
            url: "hapus-siswa/" + id,
            method: "GET",
            success: function(response) {
                $('#hapus').modal('hide');
                $('.messages').show();
                // Remove any existing alert classes
                $('.messages').removeClass('alert-success bg-success alert-danger bg-danger text-white').empty();
                // Show success message
                $('.messages').addClass('alert alert-success bg-success text-white').text(response.message).show();
                $('html, body').animate({ scrollTop: 0 }, 'fast');
                setTimeout(function() {
                    $('.messages').fadeOut(function() {
                        $(this).empty().removeClass('alert alert-success bg-success text-white').hide();
                    });
                }, 3000);
                data_siswa.ajax.reload();
            },
            error: function(xhr) {
                $('#hapus').modal('hide');
                $('.messages').show();
                // Remove any existing alert classes
                $('.messages').removeClass('alert-success bg-success alert-danger bg-danger text-white').empty();
                // Show error message
                $('.messages').addClass('alert alert-danger bg-danger text-white').text(xhr.responseJSON.message).show();
                $('html, body').animate({ scrollTop: 0 }, 'fast');
                setTimeout(function() {
                    $('.messages').fadeOut(function() {
                        $(this).empty().removeClass('alert alert-danger bg-danger text-white').hide();
                    });
                }, 3000);
            }
        });
    });

    // get data siswa
    $(".kelas").on("click", ".siswa", function(){
        let id = $(this).data('id');
        $("#class_id").val(id);
        get_class_id(id);
        var kelas = $(this).attr('id');
        $(".title-kelas").html(kelas);
        $('#siswa').modal('show');
    });

    $("#get_siswa").on('click', '#assign', function() {
        let selectid = [];
        let token = $('input[name=_token]').val();
        let class_id = $('#class_id').val();

        $(".no-class tbody .no-class-siswa:checked").each(function() {
            selectid.push($(this).data('id'));
        });

        if (selectid.length > 0) {
            $.ajax({
                url: 'send_student_to_class',
                method: 'POST',
                data: {
                    user_id: selectid,
                    _token: token,
                    class_id: class_id
                },
                success: function(response) {
                    $(".message-class").show();
                    $('.message-class').addClass('alert alert-success bg-success text-white').text(response.message).show();
                    $('.message-class').fadeIn().delay(3000).fadeOut(function() {
                        $(this).empty();
                    });
                    get_class_id(class_id);
                    $('.all-check-no-class').prop('checked', false);
                    $('.no-class-siswa').prop('checked', false);
                    selectid = []; // Reset selectid to an empty array
                    student_no_class.ajax.reload();
                    student_get_class.ajax.reload();
                },
                error: function(xhr, status, error) {
                    console.error("An error occurred: " + error);
                }
            });
        }
    });


    $("#get_siswa").on('click', '#unassign', function(){
        let selectid = [];
        let token = $('input[name=_token]').val();
        let class_id = $('#class_id').val();

        $(".student-class tbody .siswa:checked").each(function(){
            selectid.push($(this).data('id'));
        });

        if(selectid.length > 0)
            {
                $.ajax({
                    url: 'drop_student_class',
                    method: 'POST',
                    data: {
                        user_id : selectid,
                        _token : token
                    },
                    success:function(response)
                    {
                        $(".message-class").show();
                        $('.message-class').addClass('alert alert-success bg-success text-white').text(response.message).show();
                        $('.message-class').fadeIn().delay(3000).fadeOut(function() {
                            $(this).empty();
                        });
                        get_class_id(class_id);
                        $('.all-check-class').prop('checked', false);
                        $('.siswa').prop('checked', false);
                        student_no_class.ajax.reload();
                        student_get_class.ajax.reload();
                    }
                });
            }
    });

    // proses import siswa
    $('#import-siswa').on('click', '.import', function(){
        let f = $('#import-siswa')[0];
        let formData = new FormData(f);

        $.ajax({
            url: "import_siswa",
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success:function(response)
            {
                $("#import").modal('hide');
                $(".messages").show();
                $('.messages').addClass('alert alert-success bg-success text-white').text(response.message).show();
                $('.messages').fadeIn().delay(3000).fadeOut(function() {
                    $(this).empty();
                });
                data_siswa.ajax.reload();
                f.reset();
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    let errorMessages = '';

                    $.each(errors, function(key, messages) {
                        $.each(messages, function(index, message) {
                            errorMessages += message + '<br>';
                        });
                    });
                    console.log(errorMessages);
                    $("#error-message").show();
                    $('#error-message').addClass('alert alert-danger bg-danger text-white').html(errorMessages).show();
                    $('#error-message').fadeIn().delay(3000).fadeOut(function() {
                        $(this).empty();
                    });
                }
            }
        })
    });



    // Handle all-check-class checkbox change
    $('.all-check-class').on('change', function() {
        let status = $(this).is(":checked");

        $('.siswa').prop('checked', status);
    });

    $('.student-class').on('change', '.siswa', function(){
        let status = $(this).is(':checked');

        $('.siswa').each(function(){
            $('.all-check-class').prop('checked', status);
        });
    });

    // Handle all-check-class checkbox change
    $('.all-check-no-class').on('change', function() {
        let status = $(this).is(":checked");

        $('.no-class-siswa').prop('checked', status);
    });

    $('.no-class').on('change', '.no-class-siswa', function(){
        let status = $(this).is(':checked');

        $('.siswa').each(function(){
            $('.all-check-no-class').prop('checked', status);
        });
    });

    // ambil semua data kelas
    $.ajax({
        url: 'get_data_kelas', // Ganti sesuai dengan URL endpoint Anda
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            // Response adalah array objek kelas, misalnya [{id: 1, nama: 'Kelas A'}, {id: 2, nama: 'Kelas B'}]
            var kelas = response;

            // Loop untuk menambahkan opsi ke dropdown
            $.each(kelas, function(key, value) {
                $('#kelas_id').append('<option value="' + value.id + '">' + value.nama_rombel + '</option>');
            });
        }
    });

    // proses tambah data kelas
    $("#tambah-kelas").on('click', '.simpan', function(){
        let data = $("#tambah-kelas").serialize();

        $.ajax({
            url: "tambah_kelas",
            data: data,
            method: "POST",
            success:function(response)
            {
                $("#tambah").modal("hide");
                $('.messages').show();
                // Remove any existing alert classes
                $('.messages').removeClass('alert-success bg-success alert-danger bg-danger text-white').empty();
                // Show error message
                $('.messages').addClass('alert alert-success bg-success text-white').text(response.message).show();
                $('html, body').animate({ scrollTop: 0 }, 'fast');
                setTimeout(function() {
                    $('.messages').fadeOut(function() {
                        $(this).empty().removeClass('alert alert-success bg-success text-white').hide();
                    });
                }, 3000);
                data_kelas.ajax.reload();
                $("#tambah-kelas")[0].reset();
            }
        });
    });

    // click button ubah data kelas
    $(".kelas").on('click', '.ubah', function(){
       let id = $(this).data("id");

       $.ajax({
        url: "get_kelas/" + id,
        method: "GET",
        success:function(response)
        {
            $("#ubah").modal('show');
            $("#ubah-kelas").html(response);
        }
       });
    });

    // proses ubah data kelas
    $("#ubah-kelas").on("click", ".simpan", function(){
        let id = $('#id').val();
        let data = $('#ubah-kelas').serialize();

        $.ajax({
            url: "ubah_kelas/"+id,
            data: data,
            method: "PUT",
            success:function(response)
            {
                $("#ubah").modal('hide');
                $('.messages').show();
                // Remove any existing alert classes
                $('.messages').removeClass('alert-success bg-success alert-danger bg-danger text-white').empty();
                // Show error message
                $('.messages').addClass('alert alert-success bg-success text-white').text(response.message).show();
                $('html, body').animate({ scrollTop: 0 }, 'fast');
                setTimeout(function() {
                    $('.messages').fadeOut(function() {
                        $(this).empty().removeClass('alert alert-success bg-success text-white').hide();
                    });
                }, 3000);
                data_kelas.ajax.reload();
            }
        });
    });

    // confirm hapus data kelas
    $('.kelas').on('click', '.hapus', function(){
        let id = $(this).data('id');

        $.ajax({
            url: "get_data_delete/"+id,
            method: "GET",
            success:function(response)
            {
                $("#hapus").modal("show");
                $("#hapus-kelas").html(response);
            }
        });
    });

    // proses hapus data kelas
    $("#hapus-kelas").on('click', '.yes', function(){
        let id = $('#id').val();

        $.ajax({
            url: 'hapus_kelas/'+id,
            method: "GET",
            success:function(response)
            {
                $("#hapus").modal('hide');
                $('.messages').show();
                // Remove any existing alert classes
                $('.messages').removeClass('alert-success bg-success alert-danger bg-danger text-white').empty();
                // Show error message
                $('.messages').addClass('alert alert-success bg-success text-white').text(response.message).show();
                $('html, body').animate({ scrollTop: 0 }, 'fast');
                setTimeout(function() {
                    $('.messages').fadeOut(function() {
                        $(this).empty().removeClass('alert alert-success bg-success text-white').hide();
                    });
                }, 3000);
                data_kelas.ajax.reload();
            },
            error:function(xhr)
            {
                $('.messages').show();
                // Remove any existing alert classes
                $('.messages').removeClass('alert-success bg-success alert-danger bg-danger text-white').empty();
                // Show error message
                $('.messages').addClass('alert alert-danger bg-danger text-white').text(xhr.responseJSON.message).show();
                $('html, body').animate({ scrollTop: 0 }, 'fast');
                setTimeout(function() {
                    $('.messages').fadeOut(function() {
                        $(this).empty().removeClass('alert alert-danger bg-danger text-white').hide();
                    });
                }, 3000);
            }
        });
    });

    // tambah data mapel
    $("#tambah-mapel").on("click", '.simpan', function(){
        let data = $("#tambah-mapel").serialize();

        $.ajax({
            url: "tambah_mapel",
            data: data,
            method: "POST",
            success:function(response)
            {
                $("#tambah").modal('hide');
                $(".messages").show();
                $('.messages').addClass('alert alert-success bg-success text-white').text(response.message).show();
                $('.messages').fadeIn().delay(3000).fadeOut(function() {
                    $(this).removeClass('alert-success bg-success');
                });
                data_mapel.ajax.reload();
                $("#tambah-mapel")[0].reset();
            }
        });
    });

    // ubah data mapel
    $(".mapel").on('click', '.ubah', function(){
        let id = $(this).data('id');

        $.ajax({
            url: "get_mapel/"+id,
            method: "GET",
            success:function(response)
            {
                $("#ubah").modal("show");
                $("#ubah-mapel").html(response);
            }
        });
    });

    // proses ubah data mapel
    $("#ubah-mapel").on("click", ".simpan", function(){
        let id = $('#id').val();
        let data = $('#ubah-mapel').serialize();

        $.ajax({
            url: "ubah_mapel/"+id,
            method: "PUT",
            data: data,
            success:function(response)
            {
                $("#ubah").modal('hide');
                $(".messages").show();
                $('.messages').addClass('alert alert-success bg-success text-white').text(response.message).show();
                $('.messages').fadeIn().delay(3000).fadeOut(function() {
                    $(this).removeClass('alert-success bg-success');
                });
                data_mapel.ajax.reload();
            }
        });
    });

    // confirm delete mapel
    $(".mapel").on('click', '.hapus', function(){
        let id = $(this).data('id');

        $.ajax({
            url: "get_mapel_delete/"+id,
            method: "GET",
            success:function(response)
            {
                $("#hapus").modal("show");
                $("#hapus-mapel").html(response);
            }
        });
    });

    // proses hapus mapel
    $("#hapus-mapel").on('click', '.yes', function(){
        let id = $('#id').val();

        $.ajax({
            url: "hapus_mapel/"+ id,
            method: "GET",
            success:function(response){
                $("#hapus").modal('hide');
                $(".messages").show();
                $('.messages').addClass('alert alert-success bg-success text-white').text(response.message).show();
                $('.messages').fadeIn().delay(3000).fadeOut(function() {
                    $(this).removeClass('alert-success bg-success');
                });
                data_mapel.ajax.reload();
            }
        });
    });

    // proses tambah ekskul
    $("#tambah-ekskul").on('click', '.simpan', function(){
        let data = $('#tambah-ekskul').serialize();

        $.ajax({
            url: "tambah_ekskul",
            data: data,
            method: "POST",
            success:function(response)
            {
                $("#tambah").modal('hide');
                $(".messages").show();
                $('.messages').addClass('alert alert-success bg-success text-white').text(response.message).show();
                $('.messages').fadeIn().delay(3000).fadeOut(function() {
                    $(this).removeClass('alert-success bg-success');
                });
                data_ekskul.ajax.reload();
                $("#tambah-ekskul")[0].reset();
            }
        });
    });

    // get data ekskul per id untuk di tampilkan di modal edit ekskul
    $('.ekskul').on('click', '.ubah', function(){
        let id = $(this).data('id');

        $.ajax({
            url: "get_ekskul_edit/"+id,
            method: "GET",
            success:function(response)
            {
                $("#ubah").modal('show');
                $("#ubah-ekskul").html(response);
            }
        });
    });

    $('#ubah-ekskul').on('click', '.simpan', function(){
        let data = $('#ubah-ekskul').serialize();
        let id = $('#id').val();

        $.ajax({
            url: "ubah_ekskul/"+ id,
            data: data,
            method: "PUT",
            success:function(response)
            {
                $("#ubah").modal('hide');
                $(".messages").show();
                $('.messages').addClass('alert alert-success bg-success text-white').text(response.message).show();
                $('.messages').fadeIn().delay(3000).fadeOut(function() {
                    $(this).removeClass('alert-success bg-success');
                });
                data_ekskul.ajax.reload();
            }
        });
    });

    $('.ekskul').on('click', '.hapus', function(){
        let id = $(this).data('id');

        $.ajax({
            url: "get_ekskul_delete/"+id,
            method: 'GET',
            success:function(response)
            {
                $("#hapus").modal('show');
                $("#hapus-ekskul").html(response);
            }
        });
    });

    $('#hapus-ekskul').on('click', '.yes', function(){
        let id = $('#id').val();

        $.ajax({
            url: "hapus_ekskul/"+id,
            method: "GET",
            success:function(response)
            {
                $("#hapus").modal('hide');
                $(".messages").show();
                $('.messages').addClass('alert alert-success bg-success text-white').text(response.message).show();
                $('.messages').fadeIn().delay(3000).fadeOut(function() {
                    $(this).removeClass('alert-success bg-success');
                });
                data_ekskul.ajax.reload();
            }
        });
    });
});

// proses ubah data profil sekolah

