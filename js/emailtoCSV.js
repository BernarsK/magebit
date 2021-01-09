jQuery.fn.tableToCSV = function() {
    
    var clean_text = function(text){
        text = text.replace(/"/g, '""');
        return '"'+text+'"';
    };
    
	$(this).each(function(){
			var table = $(this);
			var caption = $(this).find('caption').text();
			var title = [];
			var rows = [];

			var cells = $(this).find('tr');
			var cells2 = $(this).find('th');
			var total = cells2.length;
			$(this).find('tr').each(function(){
				var data = [];
				$(this).find('th').each(function(index){
                    var text = clean_text($(this).text());
					if(text !== clean_text('Selected')){
						title.push(text);
					}
					//insert new row at last th itteration
					if (index === total - 1) {
						title.push("\n");
					}
					});
				const ifVisible = $(this).is(":visible");
				const test = $(this).is(':checked');
				const ifChecked = $(this).find('input').is(':checked');
				if(!ifChecked){
					return;
				}
				if(!ifVisible){
					return;
				}
				$(this).find('td').each(function(){
					var text = clean_text($(this).text());
					const isCheckbox = $(this).find('input').is(':checkbox');
					if(!isCheckbox){
						data.push(text);
					}
					});
				data = data.join(",");
				rows.push(data);
				});
			title = title.join(",");
			rows = rows.join("\n");
			console.log(title);
			console.log(rows);

			var csv = title + rows;
			var uri = 'data:text/csv;charset=utf-8,' + encodeURIComponent(csv);
			var download_link = document.createElement('a');
			download_link.href = uri;
			var ts = new Date().getTime();
			if(caption==""){
				download_link.download = ts+".csv";
			} else {
				download_link.download = caption+"-"+ts+".csv";
			}
			document.body.appendChild(download_link);
			download_link.click();
			document.body.removeChild(download_link);
	});
    
};