
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
            $(".messages").show();
            $('.messages').addClass('alert alert-success bg-success text-white').text(response.message).show();
            $('.messages').fadeIn().delay(3000).fadeOut(function() {
                $(this).removeClass('alert-success bg-success');
            });
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
            $(".messages").show();
            $('.messages').addClass('alert alert-success bg-success text-white').text(response.message).show();
            $('.messages').fadeIn().delay(3000).fadeOut(function() {
                $(this).removeClass('alert-success bg-success');
            });
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
            $(".messages").show();
            $('.messages').addClass('alert alert-success bg-success text-white').text(response.message).show();
            $('.messages').fadeIn().delay(3000).fadeOut(function() {
                $(this).removeClass('alert-success bg-success');
            });
            data_kelas.ajax.reload();
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
