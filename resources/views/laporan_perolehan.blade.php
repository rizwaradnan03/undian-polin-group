@extends('layout.layout')
@section('content')
@section('css')
    <style>
        .custom-button {
            background-color: green;
            color: white;
        }
    </style>
@endsection
    <div class="row mt-5">
        <div class="row mb-4">
            <div class="col-6">
                <select id="month" class="form-control">
                    <option value="#" selected disabled>--Pilih Bulan--</option>
                    <option value="01">Januari</option>
                    <option value="02">Februari</option>
                    <option value="03">Maret</option>
                    <option value="04">April</option>
                    <option value="05">Mei</option>
                    <option value="06">Juni</option>
                    <option value="07">Juli</option>
                    <option value="08">Agustus</option>
                    <option value="09">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                </select>
            </div>
            <div class="col-6">
                <select id="year" class="form-control">
                    <option value="#" disabled selected>--Silahkan Pilih Bulan--</option>
                </select>
            </div>
        </div>
        <div class="table">
            <table id="datatables" class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Rekening</th>
                        <th>Nama</th>
                        <th>Saldo</th>
                        <th>Point</th>
                    </tr>
                    <tbody id="table">

                    </tbody>
                </thead>
            </table>
        </div>
    </div>
@endsection
@section('js')
    <script>
       $("#datepicker").datepicker({
        dateFormat: "yy-mm",
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        onClose: function(dateText, inst) {
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
            $(this).datepicker('setDate', new Date(year, month, 1));
        }
    });

        $('#month').on("change", function(){
            let month = $('#month').val();
            $('#month').attr("disabled","disabled")
            let html = ""
                html += "<option disabled selected>--Pilih Tahun--</option>"
                for(let i = 2020;i <= 2050;i++){
                    html += "<option value="+i+">"+i+"</option>"
                }
            $('#year').html(html)

            $('#year').on("change", function(){
                let year = $('#year').val()
                $('#year').attr("disabled","disabled")
                $.ajax({
                    url: "{{url('/getPerolehan')}}",
                    data: {month: month, year: year},
                    type: "GET",
                }).done(function(reponse){
                    let data = JSON.parse(reponse);

                    let table = "";
                    let no = 0;
                    if(data.status == "berhasil"){
                        for(let i = 0;i < data.data.length;i++){
                            table += "<tr>"
                                table += "<td>"+ ++no; +"</td>"
                                table += "<td>"+ data.data[i].noacc +"</td>"
                                table += "<td>"+ data.data[i].namaidentitas +"</td>"
                                table += "<td>Rp"+ new Intl.NumberFormat('en-US').format(data.data[i].saldo) +"</td>"
                                table += "<td>"+ data.data[i].point +"</td>"
                            table += "</tr>"
                        }
                    $('#table').html(table)
                    $('#datatables').DataTable({
                        dom: 'Bfrtip',
                        buttons: [{
                            extend: 'excel',
                            text: '<h4 style="font-size: 13px;">Export Excel</h4>',
                            titleAttr: 'Export To Excel',
                            className: 'custom-button'
                        },],

                    });
                    }else if(data.status == "gagal"){
                        Swal.fire({
                            icon: 'error',
                            title: 'Data Tidak Ditemukan!',
                            confirmButtonText: 'Ok',
                        }).then((result) => {
                            if(result.isConfirmed){
                                location.reload(true)
                            }else{
                                location.reload(true)
                            }
                        })
                    }
                })
                })
            })
    </script>
@endsection
