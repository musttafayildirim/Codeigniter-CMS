$(document).ready(function () {
    $(".remove-btn").click(function (e) {
        var $data_url = $(this).data("url");

        Swal.fire({
            title: 'Emin misiniz?',
            text: "Bu işlemi geri alamayacaksınız.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Evet, sil!',
            cancelButtonText: 'Hayır'
        }).then((result) => {
            if (result.value) {
                window.location.href = $data_url;
            }
        })
    })

});
