
<style>
table {
  border-collapse: collapse;
}

table, th, td {
  border: 1px solid black;
}
</style>
<html>
    <table id="tblData">
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Nama Investor</th>
            <th>Nomor Rekening</th>
            <th>Nomor SID</th>
            <th>Nomor KTP</th>
            <th>NPWP</th>
            <th>PASSPORT</th>
            <th>Alamat 1</th>
            <th>Alamat 2</th>
            <th>L/A</th>
            <th>Status Investor</th>
            <th>Kewarganegaraan</th>
            <th>Tingkat Pajak Equi</th>
            <th>Tingkat Pajak Corp</th>
            <th>Tingkat Pajak MTN</th>
            <th>Nama Pemegang Rekening</th>
            <th>Kode Pemegang Rekening</th>
            <th>Jumlah</th>
            <th>Status Rekening</th>
            <th>Status Balance</th>
            <th>Percentage (%)</th>
        </tr>
        <tr>
        @foreach($data as $investor)
            <tr style="background-color:blue;color:white;">
                <td>{{$investor['no']}}</td>
                <td>{{$investor['tanggal']}}</td>
                <td>{{$investor['nama_investor']}}</td>
                <td>{{$investor['nomor_rekening']}}</td>
                <td>{{$investor['nomor_sid']}}</td>
                <td>{{$investor['nomor_ktp']}}</td>
                <td>{{$investor['npwp']}}</td>
                <td>{{$investor['passport']}}</td>
                <td>{{$investor['alamat_1']}}</td>
                <td>{{$investor['alamat_2']}}</td>
                <td>{{$investor['la']}}</td>
                <td>{{$investor['status_investor']}}</td>
                <td>{{$investor['kewarganegaraan']}}</td>
                <td>{{$investor['tingkat_pajak_equi']}}</td>
                <td>{{$investor['tingkat_pajak_corp']}}</td>
                <td>{{$investor['tingkat_pajak_mtn']}}</td>
                <td>{{$investor['nama_pemegang_rekening']}}</td>
                <td>{{$investor['kode_pemegang_rekening']}}</td>
                <td>{{$investor['jumlah']}}</td>
                <td>{{$investor['status_rekening']}}</td>
                <td>{{$investor['status_balance']}}</td>
                <td>{{$investor['percentage']}}</td>
            </tr>
        @endforeach
        </tr>
    </table>
    <button onclick="exportTableToExcel('tblData')">Export Table Data To Excel File</button>
<script>
function exportTableToExcel(tableID, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xlsx':'excel_data.xlsx';
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
}
</script>
</html>