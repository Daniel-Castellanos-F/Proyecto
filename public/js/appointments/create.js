let $hours, $iRadio, $long, $lat;


const noHoursAlert = `<div class="alert alert-warning" role="alert">
              <strong>Lo sentimos!</strong> No se encontraron horas disponibles para este día 
            </div>`;

$(function () {
    $hours = $('#hours');

    const $date = $('#date');
    const $escenario = $('#escenario');

    $date.change( () =>{
      const escenarioId = $escenario.val();
      const selectedDate = $date.val();
      const url = `/api/schedule/hours?date=${selectedDate}&escenario_id=${escenarioId}`;
      $.getJSON(url, displayHours);           
    });

    $escenario.change(displayHours);
});

function displayHours(data){
  if (!data.morning && !data.afternoon || data.morning.length===0 && data.afternoon.length===0 ){
      $hours.html(noHoursAlert);
    return;
  }

  let htmlHours ='';
  iRadio = 0;

  if (data.morning) {
      const morning_intervals = data.morning;
      morning_intervals.forEach(interval => {
          htmlHours += getRadioIntervalHtml(interval);
      });
  }

  if (data.afternoon) {
      const afternoon_intervals = data.afternoon;
      afternoon_intervals.forEach(interval => {
          htmlHours += getRadioIntervalHtml(interval);
      });
  }
  $hours.html(htmlHours);
}

function getRadioIntervalHtml(interval){
      const text = `${interval.start} - ${interval.end}`;
      return `<div class="custom-control custom-radio mb-3">
                  <input name="schedule_time" value="${interval.start}" class="custom-control-input" id="interval${iRadio}" type="radio" required>
                  <label class="custom-control-label" for="interval${iRadio++}">${text}</label>
              </div>`
}