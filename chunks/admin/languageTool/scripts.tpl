<script type="text/javascript">
$(document).ready(function() {
$('#langFile').change(function() {
	getFile($(this).val());
})

$('#btnEdit').click(function(event) {
	event.preventDefault();
	var data = Object();
	data['en'] = $('#english').val();
	data['ar'] = $('#arabic').val();

	jPut.file.update($('#field').val(), data);

	saveFile(jPut.file.data);
});
});

function getFile (file) {
    $('#loadingContainer').show();
    $.ajax({
    	url: '../handlers/LangHandler.php',
    	type: 'POST',
    	data: {
    		operation: 'getFile',
    		file: file,
    	},
    })
    .done(function(data) {
    	jPut.file.data = data;
    })
    .fail(function() {
    	console.log("error");
    })
    .always(function() {
    	$('#loadingContainer').hide();
    });

}

function fnOpenEdit(index) {

    $('#loadingContainer').show();
    $('#field').val(index);
    $('#english').val(jPut.file.data[index].en);
    $('#arabic').val(jPut.file.data[index].ar);
   	Materialize.updateTextFields();
    $('#editModal').openModal();
    $('#loadingContainer').hide();
}

function saveFile (data) {
    $('#loadingContainer').show();
    JSON.stringify(data);
    $.ajax({
    	url: '../handlers/LangHandler.php',
    	type: 'POST',
    	data: {
    		operation: 'saveFile',
    		fileName: $('#langFile').val(),
    		data: data,
    	},
    })
    .done(function(data) {
    $('#editModal').closeModal();
    })
    .fail(function() {
    	console.log("error");
    })
    .always(function() {
    	$('#loadingContainer').hide();
    });
}
</script>