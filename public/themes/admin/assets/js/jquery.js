$(document).ready(function () {
  $("#searchDataList").keyup(function () {
    var value = $(this).val().toLowerCase();
    $("#bodyTableDataList tr").filter(function () {
      var rowText = $(this).children('td:not(:last-child)').text().toLowerCase();
      $(this).toggle(rowText.indexOf(value) > -1);
    });
  });
});
