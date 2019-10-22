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
        
    </table>
</html>