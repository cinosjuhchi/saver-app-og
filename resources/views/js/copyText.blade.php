<script>
function copyShare(event) {
    let target = event.currentTarget;
    let link = target.getAttribute("data-link");
    var baseUrl = "{{ env('COPY_URL') }}";
    let type = target.getAttribute("data-type");

    if(type == "folder")
    {
        var copyText = baseUrl + "/share-folder/" + link;
    }else{
        var copyText = baseUrl + "/share-photo/" + link;
    }

    // Salin teks ke clipboard
    navigator.clipboard.writeText(copyText).then(function() {
        // Berhasil menyalin, tampilkan pesan sukses
        alert("Link berhasil disalin: " + copyText);
    }, function() {
        // Gagal menyalin, tampilkan pesan error
        alert("Gagal menyalin link.");
    });
}
</script>