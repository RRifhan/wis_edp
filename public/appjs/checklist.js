$(document).ready(function () {
  $("#btncek").on("click", function () {
    let periode = $("#periode").val();
    let kdgudang = $("#kdgudang").val();
    if (periode == "") {
      swal({
        title: "Harap tentukan periode dulu!",
        type: "error",
        timer: 1000
      });
    } else {
      $.ajax({
        type: "POST",
        dataType: "json",
        // url: window.location.pathname + "/ambildata",
        url: window.location.pathname + "/cek_ftp",
        data: {
          periode: periode,
          kdgudang: kdgudang
        },
        beforeSend: function () {
          // setting a timeout
          $("#hasil").empty();
          $("#btncek").prop('disabled', true);
        },
        success: function (hasil) {
          console.log(hasil);
          $("#hasil").html(buatTable(hasil));
          $("table td span").css("cursor", "pointer");
          $("table td span").on("mouseenter", function () {
            $(this).css("text-decoration", "underline");
          });
          $("table td span").on("mouseleave", function () {
            $(this).css("text-decoration", "none");
          });

          $("#btncek").prop('disabled', false);
        },
        error: function (xhr, textStatus, thrownError) {
          $("#modal").modal("show");
          swal({
            title: "FAILED",
            text: xhr.responseText,
            type: "error"
          });
        }
      });
    }
  });
}); //dom ready

function buatTable(hasil) {
  if (hasil.length > 0) {
    let th = `<table class="table">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">KDGUDANG</th>
                    <th scope="col">TANGGAL</th>
                    <th scope="col">SHIFT1</th>
                    <th scope="col">SHIFT2</th>
                    <th scope="col">SHIFT3</th>
                    </tr>
                </thead>
            <tbody>`;
    let tr = "";
    hasil.forEach(function (has) {
      tr += `
                <tr>
                <th scope="row">${has.kdgudang}</th>
                <td>${has.tanggal}</td>
                <td>${
                  has.shift1 == "NOK"
                    ? `<span onClick="cekDetail('${has.kdgudang}','${
                        has.tanggal
                      }','1')" class="badge badge-danger">${has.shift1}</span>`
                    : has.shift1
                }</td>
                <td>${
                  has.shift2 == "NOK"
                    ? `<span onClick="cekDetail('${has.kdgudang}','${
                        has.tanggal
                      }','2')" class="badge badge-danger">${has.shift2}</span>`
                    : has.shift2
                }</td> 
                <td>${
                  has.shift3 == "NOK"
                    ? `<span onClick="cekDetail('${has.kdgudang}','${
                        has.tanggal
                      }','3')" class="badge badge-danger">${has.shift3}</span>`
                    : has.shift3
                }</td> 
                </tr>`;
    });

    let tf = `</tbody></table>`;
    return th + tr + tf;
  } else {
    return "Data Tidak ada";
  }
}

function cekDetail(kdgudang, tanggal, shift) {
  $.ajax({
    type: "POST",
    dataType: "json",
    url: window.location.pathname + "/cekDetail",
    data: {
      kdgudang: kdgudang,
      tanggal: tanggal,
      shift: shift
    },
    success: function (data) {
      let hasil = "";
      if (data.file_excel != data.jmlexcel && data.jmlexcel != 0) {
        hasil += `File Excel kurang hanya ada ${data.file_excel} seharusnya ${
          data.jmlexcel
        } <br>`;
      }
      if (data.serverdc != data.jmlfotodc && data.jmlfotodc != 0) {
        hasil += `Foto Server DC kurang hanya ada ${data.serverdc} seharusnya ${
          data.jmlfotodc
        } <br>`;
      }
      if (data.servernondc != data.jmlfotonondc && data.jmlfotonondc != 0) {
        hasil += `Foto Server Non DC kurang hanya ada ${
          data.servernondc
        } seharusnya ${data.jmlfotonondc} <br>`;
      }
      if (data.ups != data.jmlfotoups && data.jmlfotoups) {
        hasil += `Foto UPS kurang hanya ada ${data.ups} seharusnya ${
          data.jmlfotoups
        } <br>`;
      }
      if (data.suhu != data.jmlfotosuhu && data.jmlfotosuhu != 0) {
        hasil += `Foto Suhu kurang hanya ada ${data.suhu} seharusnya ${
          data.jmlfotosuhu
        } <br>`;
      }
      if (data.router != data.jmlfotorb && data.jmlfotorb != 0) {
        hasil += `Foto Router kurang hanya ada ${data.router} seharusnya ${
          data.jmlfotorb
        } <br>`;
      }
      if (data.modem != data.jmlfotomodem && data.jmlfotomodem != 0) {
        hasil += `Foto Modem kurang hanya ada ${data.modem} seharusnya ${
          data.jmlfotomodem
        } <br>`;
      }
      if (data.webups10 != data.jmlwebups10 && data.jmlwebups10 != 0) {
        hasil += `Foto Web UPS 10KVA  kurang hanya ada ${data.webups10} seharusnya ${
          data.jmlwebups10
        } <br>`;
      }
      if (data.webups6 != data.jmlwebups6 && data.jmlwebups6 != 0) {
        hasil += `Foto Web UPS 6 KVA kurang hanya ada ${data.webups6} seharusnya ${
          data.jmlwebups6
        } <br>`;
      }
      swal({
        type: "error",
        title: "Ada yang kurang!!",
        html: hasil
      });
    },
    error: function (responseTxt, statusTxt, xhr) {
      swal(xhr);
    }
  });
}