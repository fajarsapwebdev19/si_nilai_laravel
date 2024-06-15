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
        }
    });
});

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
   })
})
