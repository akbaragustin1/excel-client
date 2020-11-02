<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=".$first_date.".xlsx");
?>
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
            <th>Nama Investor</th>
            <th>Alamat 1</th>
            <th>Alamat 2</th>
            <th>Propinsi</th>
            <th>L/A</th>
            <th>Status</th>
            <th>Nama Pemegang Rekening</th>
            <th>Jumlah</th>
            <th>Percentage (%)</th>
        </tr>
        @foreach($data as $investor)
            @if($investor['status_jumlah'] == 'b')
            <tr style="background-color:#00BFFF;color:black;">
            @elseif($investor['status_jumlah'] == 'k')
            <tr style="background-color:#FFD700;color:black;">
            @elseif($investor['status_jumlah'] == 'h')
            <tr style="background-color:#00FF7F;color:black;">
            @elseif($investor['status_jumlah'] == 'm')
            <tr style="background-color:#F95C5C;color:black;">
            @else
            <tr style="color:black;">
            @endif
                <td>{{$investor['no']}}</td>
                <td>{{$investor['nama_investor']}}</td>
                <td>{{$investor['alamat_1']}}</td>
                <td>{{$investor['alamat_2']}}</td>
                <td>{{$investor['propinsi']}}</td>
                <td>{{$investor['la']}}</td>
                <td>{{$investor['status_investor']}}</td>
                <td>{{$investor['nama_pemegang_rekening']}}</td>
                <td>{{$investor['jumlah']}}</td>
                <td>{{$investor['percentage']}}</td>
            </tr>
        @endforeach
        
    </table>
</html>