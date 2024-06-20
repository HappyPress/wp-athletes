jQuery(document).ready(function ($) {
    $('#wp_athletes_import_csv').on('change', function (e) {
        var file = e.target.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var content = e.target.result;
                var rows = content.split("\n");
                var html = '<h4>CSV Preview:</h4><table><thead><tr>';
                var headers = rows[0].split(",");
                headers.forEach(function (header) {
                    html += '<th>' + header + '</th>';
                });
                html += '</tr></thead><tbody>';
                for (var i = 1; i < rows.length; i++) {
                    html += '<tr>';
                    var cells = rows[i].split(",");
                    cells.forEach(function (cell) {
                        html += '<td>' + cell + '</td>';
                    });
                    html += '</tr>';
                }
                html += '</tbody></table>';
                $('#csv_preview').html(html);
            };
            reader.readAsText(file);
        }
    });

    $('#wp_athletes_import_form').on('submit', function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $('#import_progress').show();
        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            xhr: function () {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function (evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = (evt.loaded / evt.total) * 100;
                        $('#import_progress_bar').val(percentComplete);
                    }
                }, false);
                return xhr;
            },
            success: function (response) {
                $('#import_progress').hide();
                alert('Import complete!');
                location.reload();
            }
        });
    });
});
