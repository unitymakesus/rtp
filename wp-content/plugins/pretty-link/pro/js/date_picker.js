var plp_load_datepicker = function() {
  //I guess these can be tweaked as time goes, but for now these seem like reasonable targets
  var currentYear = new Date().getFullYear();
  var pastYears = currentYear - 100;
  var futureYears = currentYear + 50;

  var timeFormat = 'HH:mm:00Z';
  var showTime   = true;
  var showHours  = true;
  var showMinutes = true;
  var showSeconds = false;
  var showMillisec = false;
  var showMicrosec = false;
  var showTimezone = true;

  //Front End needs to display cleaner
  if(typeof PrliDatePicker != "undefined") {
    timeFormat = PrliDatePicker.timeFormat;
    showTime = Boolean(PrliDatePicker.showTime);
    showHours = Boolean(PrliDatePicker.showHours);
    showMinutes = Boolean(PrliDatePicker.showMinutes);
    showSeconds = Boolean(PrliDatePicker.showSeconds);
    showMillisec = Boolean(PrliDatePicker.showMillisec);
    showMicrosec = Boolean(PrliDatePicker.showMicrosec);
    showTimezone = Boolean(PrliDatePicker.showTimezone);
  }

  jQuery('.prli-date-picker').datetimepicker( {
    dateFormat : 'yy-mm-dd',
    timeFormat: timeFormat,
    yearRange : pastYears + ":" + futureYears,
    changeMonth : true,
    changeYear : true,
    showTime : showTime,
    showHours : showHours,
    showMinutes : showMinutes,
    showSeconds : showSeconds,
    showMillisec : showMillisec,
    showMicrosec : showMicrosec,
    showTimezone : showTimezone,
    onSelect : function (date, inst) {
      jQuery(this).trigger('prli-date-picker-selected', [date, inst]);
    },
    onChangeMonthYear : function (month, year, inst) {
      jQuery(this).trigger('prli-date-picker-changed', [month, year, inst]);
    },
    onClose : function (date, inst) {
      jQuery(this).val(date.trim()); //Trim off white-space if any
      jQuery(this).trigger('prli-date-picker-closed', [date, inst]);
    }
  });
};

jQuery(document).ready(function($) {
  plp_load_datepicker();
});

