$(document).ready(function () {
  var table = $('#myTable').DataTable();
  var dateInput1 = '<input type="date" id="min-date" class="form-control" style="width: 140px; display: inline-block;" />';
  var dateInput2 = '<input type="date" id="max-date" class="form-control" style="width: 140px; display: inline-block;" />';
  $('#inputSearch').before(dateInput1).before(dateInput2);
  $.fn.dataTable.ext.search.push(
    function (settings, data, dataIndex) {
      var min = $('#min-date').val();
      var max = $('#max-date').val();
      var date = $(table.row(dataIndex).node()).find('.date-column').text().split(' ')[0];
      if (
        (min === "" || date >= min) &&
        (max === "" || date <= max)
      ) {
        return true;
      }
      return false;
    }
  );
  $('#min-date, #max-date').change(function () {
    table.draw();
  });
});
