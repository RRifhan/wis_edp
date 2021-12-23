$(document).ready(function() {
  var table = $("#dataTable").DataTable({
    
    lengthChange: false,
    dom:
      '<"row btn-group col-lg-12 "<"col-sm-12 col-md-9"B><"col-sm-12 col-md-3 float-right"f>><"row"rt><"row"<"col-sm-12 col-md-6 float-right"i><"col-sm-12 col-md-6 float-right"p>>',
    buttons: ["copy", "csv", "colvis", "pageLength"],
    responsive: true,
    serverSide: true,
    processing: true,
    lengthMenu: [
      [25, 50, 100, -1],
      ["25 rows", "50 rows", "100 rows", "Show all"]
    ],
    fnInitComplete: function() {
      if ($("#mod_menu").val() != "Y") {
        $(".admin-menu").hide();
      }
    },
    fnDrawCallback: function() {
      if ($("#mod_menu").val() != "Y") {
        $(".admin-menu").hide();
      }
    },
    ajax: {
      url: "/edp/rekapmtc/get_data_json",
      type: "POST",
      data: {nik:window.location.pathname.slice(-10)}
    },
    order: [[ 2, "asc" ]],
    columns: [
      {
        data: "KodeToko",
        title: "KDTK"
      },
      {
        data: "NamaToko",
        title: "Nama Toko"
      },
      {
        data: "tanggal",
        title: "TANGGAL"
      },
      {
        data: "jmltable",
        title: "JML TB"
      }, {
        data: "totaldb",
        title: "ERRLOG"
      }
      
    ]
  });
}); //domready
