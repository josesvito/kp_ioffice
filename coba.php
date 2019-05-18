<?php

$con = mysqli_connect("localhost", "root", "", "dks_db2019") or die("error : ". mysqli_error());
$query = "SELECT * FROM `dokumen`";

$results =  mysqli_query($con, $query);

echo "<table>" ;
echo "<tr>";
echo "<tr><td> Nomor Doc </td> ";
echo "<td> Judul </td>";
echo "<td> Warning </td>";
echo "<td> Expired </td>";
echo "</tr>";
while ($row = mysqli_fetch_array($results)) {
    //echo ;

    echo "<tr>";
    echo "<tr><td> ".$row['no_dokumen']." </td> ";
    echo "<td> ".$row['no_dokumen']." </td>";
    echo "<td> ".warningTerms($row['no_dokumen'])." </td>";
    echo "<td> ".warningExpired($row['no_dokumen'])." </td>";
    echo "</tr>";
}
echo "</table>" ;


function warningTerms($nomor)
{
    $con = mysqli_connect("localhost", "root", "", "dks_db2019") or die("error : ". mysqli_error());


    $query="SELECT * FROM perjanjian
        JOIN dokumen ON dokumen.no_dokumen = perjanjian.dokumen_no_dokumen
        JOIN mitra ON mitra.id_mitra = perjanjian.Mitra_id_mitra
        WHERE datediff(current_date(), tanggal_akhir) >= -150 AND
            datediff(current_date(), tanggal_akhir) <= 0 and dokumen.no_dokumen = '$nomor'  ";
    $results =  mysqli_query($con, $query);

    $count = mysqli_num_rows($results);
    if ($count > 0) {
        return "Warning";
    } else {
        return "Masih Aktif ";
    }
}

function warningExpired($nomor)
{
    $con = mysqli_connect("localhost", "root", "", "dks_db2019") or die("error : ". mysqli_error());


    $query="SELECT * FROM perjanjian
    JOIN dokumen ON dokumen.no_dokumen = perjanjian.dokumen_no_dokumen
    JOIN mitra ON mitra.id_mitra = perjanjian.Mitra_id_mitra
    WHERE tanggal_akhir < current_date() and dokumen.no_dokumen = '$nomor'  ";
    $results =  mysqli_query($con, $query);

    $count = mysqli_num_rows($results);

    if ($count > 0) {
        return "Expired";
    } else {
        return "Masih Aktif";
    }
    //return  $count;
}

//echo  warningExpired('009/SKB/UKM/IX/2008');
