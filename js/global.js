$('button#view-ol-item').on('click', function(){
	
	var name = $('input#searchbox-item-ol').val();
	
		$.post('ajax/admin_view_contents.php', {name: name, category: "ol-item"}, function(data)
		{
			$('div.js-contents-items').html(data);
		});
	
});
$('button#view-ol-service').on('click', function(){
	
	var name = $('input#searchbox-service-ol').val();
	
		$.post('ajax/admin_view_contents.php', {name: name, category: "ol-service"}, function(data)
		{
			$('div.js-contents-services').html(data);
		});
	
});
$('button#view-wi-item').on('click', function(){
	
	var name = $('input#searchbox-item-wi').val();
	
		$.post('ajax/admin_view_contents.php', {name: name, category: "wi-item"}, function(data)
		{
			$('div.js-contents-items-wi').html(data);
		});
	
});
$('button#view-wi-service').on('click', function(){
	
	var name = $('input#searchbox-service-wi').val();
	
		$.post('ajax/admin_view_contents.php', {name: name, category: "wi-service"}, function(data)
		{
			$('div.js-contents-services-wi').html(data);
		});
	
});
$('button#view-ol-clients').on('click', function(){
	
	var name = $('input#searchbox-clients-ol').val();
	
		$.post('ajax/admin_view_contents.php', {name: name, category: "ol-clients"}, function(data)
		{
			$('div.js-contents-clients-ol').html(data);
		});
	
});
$('button#view-wi-clients').on('click', function(){
	
	var name = $('input#searchbox-clients-wi').val();
	
		$.post('ajax/admin_view_contents.php', {name: name, category: "wi-clients"}, function(data)
		{
			$('div.js-contents-clients-wi').html(data);
		});
});

// online users
$(function(){
	$("#dp-ol-item").datepicker({
	    	  changeMonth: true,//this option for allowing user to select month
		      changeYear: true,
	    onSelect: function(dateText, inst) {
	        var date = $(this).val();

	     	$.post('ajax/schedule.php', {date: date, category: 'item-ol'}, function(data)
			{
				$('div#sched-ol-item').html(data);
			});  
	    }
	});
});
$(function(){
    $('input#tp-ol-item').timepicker({
    	timeFormat: 'HH:mm:ss',
    	minTime: '10:15:00',
    	maxTime: '20:00:00', // 11:45:00 AM,
        startTime: new Date(0,0,0,10,15,0), // 3:00:00 PM - noon
        interval: 30, // 15 minutes
    	onSelect: function(dateText, inst){
	    	var time = $(this).val();
	    	
    	}
    });
});
$(function(){
	$("#dp-ol-service").datepicker({
	    	  changeMonth: true,//this option for allowing user to select month
		      changeYear: true,
	    onSelect: function(dateText, inst) {
	        var date = $(this).val();

	     	$.post('ajax/schedule.php', {date: date, category: 'service-ol'}, function(data)
			{
				$('div#sched-ol-service').html(data);
			});  
	    }
	});
});
$(function(){
    $('input#tp-ol-service').timepicker({
    	timeFormat: 'HH:mm:ss',
    	minTime: '10:15:00',
    	maxTime: '20:00:00', // 11:45:00 AM,
        startTime: new Date(0,0,0,10,15,0), // 3:00:00 PM - noon
        interval: 30, // 15 minutes
    	onSelect: function(dateText, inst){
	    	var time = $(this).val();
	    	
    	}
    });
});

// walkin users
$(function(){
	$("#dp-wi-item").datepicker({
	    	  changeMonth: true,//this option for allowing user to select month
		      changeYear: true,
	    onSelect: function(dateText, inst) {
	        var date = $(this).val();

	     	$.post('ajax/schedule.php', {date: date, category: 'item-wi'}, function(data)
			{
				$('div#sched-wi-item').html(data);
			});  
	    }
	});
});
$(function(){
    $('input#tp-wi-item').timepicker({
    	timeFormat: 'HH:mm:ss',
    	minTime: '10:15:00',
    	maxTime: '20:00:00', // 11:45:00 AM,
        startTime: new Date(0,0,0,10,15,0), // 3:00:00 PM - noon
        interval: 30, // 15 minutes
    	onSelect: function(dateText, inst){
	    	var time = $(this).val();
	    	
    	}
    });
});
$(function(){
	$("#dp-wi-service").datepicker({
	    	  changeMonth: true,//this option for allowing user to select month
		      changeYear: true,
	    onSelect: function(dateText, inst) {
	        var date = $(this).val();

	     	$.post('ajax/schedule.php', {date: date, category: 'service-wi'}, function(data)
			{
				$('div#sched-wi-service').html(data);
			});  
	    }
	});
});
$(function(){
    $('input#tp-wi-service').timepicker({
    	timeFormat: 'HH:mm:ss',
    	minTime: '10:15:00',
    	maxTime: '20:00:00', // 11:45:00 AM,
        startTime: new Date(0,0,0,10,15,0), // 3:00:00 PM - noon
        interval: 30, // 15 minutes
    	onSelect: function(dateText, inst){
	    	var time = $(this).val();
	    	
    	}
    });
});