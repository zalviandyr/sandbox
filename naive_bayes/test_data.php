<?php
$mp1 = [
    'Jalan Kaki', //0
    'Sepeda', //1
    'Sepeda Motor',
]; //2
$mp2 = [
    'SD / sederajat', //0
    'SMP / sederajat', //1
    'SMA / sederajat',
]; //2
$mp3 = [
    'Petani', //0
    'Wiraswasta', //1
    'Sudah Meninggal',
]; //2
$mp4 = [
    'SD / sederajat', //0
    'SMP / sederajat', //1
    'SMA / sederajat',
]; //2
$mp5 = [
    'Petani', //0
    'PNS/TNI/POLRI', //1
    'Tidak bekerja',
]; //2
$mp6 = [
    'Kurang dari Rp. 500,000', //0
    'Rp. 1,000,000 - Rp. 1,999,999', //1
    'Rp. 2,000,000 - Rp. 4,999,999', //2
    'Rp. 500,000 - Rp. 999,999', //3
    'Tidak Berpenghasilan',
]; //4

$mp7 = [
    'Disiplin', //0
    'Tidak Disiplin', //1
];

$data2 = [];

//1
$d = [];
$d['nama'] = 'ADITYA PUTRA ALMANDA';
$d['alat_transportasi'] = $mp1[1];
$d['pendidikan_ayah'] = $mp2[2];
$d['pekerjaan_ayah'] = $mp3[1];
$d['pendidikan_ibu'] = $mp4[2];
$d['pekerjaan_ibu'] = $mp5[2];
$d['penghasilan_ortu'] = $mp6[1];
$d['keterangan'] = $mp7[1];
$data2[] = $d;

//2
$d = [];
$d['nama'] = 'ADZIN MUHAMMAD ABIYYU';
$d['alat_transportasi'] = $mp1[0];
$d['pendidikan_ayah'] = $mp2[0];
$d['pekerjaan_ayah'] = $mp3[0];
$d['pendidikan_ibu'] = $mp4[0];
$d['pekerjaan_ibu'] = $mp5[2];
$d['penghasilan_ortu'] = $mp6[3];
$d['keterangan'] = $mp7[0];
$data2[] = $d;

//3
$d = [];
$d['nama'] = 'Agil Kalsa Putra';
$d['alat_transportasi'] = $mp1[2];
$d['pendidikan_ayah'] = $mp2[0];
$d['pekerjaan_ayah'] = $mp3[0];
$d['pendidikan_ibu'] = $mp4[0];
$d['pekerjaan_ibu'] = $mp5[2];
$d['penghasilan_ortu'] = $mp6[2];
$d['keterangan'] = $mp7[1];
$data2[] = $d;


//5
$d = [];
$d['nama'] = 'REFALDA RAMZI';
$d['alat_transportasi'] = $mp1[0];
$d['pendidikan_ayah'] = $mp2[2];
$d['pekerjaan_ayah'] = $mp3[2];
$d['pendidikan_ibu'] = $mp4[2];
$d['pekerjaan_ibu'] = $mp5[2];
$d['penghasilan_ortu'] = $mp6[4];
$d['keterangan'] = $mp7[0];
$data2[] = $d;

//6
$d = [];
$d['nama'] = 'PUTRI AMELLIZA';
$d['alat_transportasi'] = $mp1[0];
$d['pendidikan_ayah'] = $mp2[0];
$d['pekerjaan_ayah'] = $mp3[0];
$d['pendidikan_ibu'] = $mp4[1];
$d['pekerjaan_ibu'] = $mp5[0];
$d['penghasilan_ortu'] = $mp6[4];
$d['keterangan'] = $mp7[0];
$data2[] = $d;
