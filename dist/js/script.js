$(document).ready(function () {
  $('#search').on('keyup', function () {
    var searchText = $(this).val().trim();

    if (searchText.length >= 3) {
      // Minimal 3 karakter untuk memicu pencarian
      $.ajax({
        url: 'search.php',
        type: 'GET',
        data: { search: searchText },
        dataType: 'json',
        beforeSend: function () {
          // Tampilkan loader atau pesan loading
          $('#search-results').html('<p>Loading...</p>');
        },
        success: function (response) {
          if (response.length > 0) {
            var html = '<table id="example1" class="table table-bordered table-striped">';
            html += '<thead><tr><th style="width: 5%;">No</th><th style="width: 15%;">Id Skripsi</th><th style="width: 40%;">Judul Skripsi</th><th style="width: 25%;">Nama Mahasiswa</th><th style="width: 15%;">Read</th></tr></thead>';
            html += '<tbody>';

            $.each(response, function (index, data) {
              html += '<tr>';
              html += '<td>' + (index + 1) + '</td>';
              html += '<td>' + data.id + '</td>';
              html += '<td>' + data.judul + '</td>';
              html += '<td>' + data.penerbit + '</td>';
              html += '<td><a href="pdf_viewer.php?kode=' + data.id + '" title="Buka PDF" class="btn btn-danger"><i class="fa fa-file"></i> Pdf</a></td>';
              html += '</tr>';
            });

            html += '</tbody></table>';
            $('#search-results').html(html);
          } else {
            $('#search-results').html('<p>No results found</p>');
          }
        },
        error: function () {
          $('#search-results').html('<p>Error fetching results</p>');
        },
      });
    } else {
      // Kosongkan hasil pencarian jika panjang input kurang dari 3 karakter
      $('#search-results').html('');
    }
  });
});
