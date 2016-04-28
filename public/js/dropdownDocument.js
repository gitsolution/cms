$("#id_section").change(event => {
	$.get('towns/${event.target.value}', function(res, sta){
		res.forEach(element => {
			$("#id_category").append('<option value=${element.id}> ${element.title} </option>');
		});
	});
});

