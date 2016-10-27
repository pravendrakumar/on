
$(document).ready(function (){
$("#endtdate1").datepicker({ dateFormat: 'dd-mm-yy',changeMonth: true });
$("#reminderdate").datepicker({ dateFormat: 'dd-mm-yy' });
$('#starttime1').timepicker({ 'scrollDefault': 'now' });
$('#endtime1').timepicker({ 'scrollDefault': 'now' });
$('#remindertime').timepicker({ 'scrollDefault': 'now' });

$("#startdate1").datepicker({ 
    dateFormat: 'dd-mm-yy',
    changeMonth: true,
    minDate: new Date(),
    maxDate: '+2y',
    onSelect: function(date){
        var DateArr = date.split('-');
        var slDate  = DateArr[2]+'-'+DateArr[1]+'-'+DateArr[0];
        var selectedDate = new Date(slDate);
        var msecsInADay = 86400000;
        var endDate = new Date(selectedDate.getTime() + msecsInADay);
        
        $("#endtdate1").datepicker( "option", "minDate", endDate );
        $("#endtdate1").datepicker( "option", "maxDate", '+2y' );

    }
});

});