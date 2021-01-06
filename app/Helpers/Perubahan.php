<?php

function jenisKelamin($nilai)
{
    return $nilai == 1 ? "Laki-Laki" : "Perempuan";
}

function statusPekerjaan($nilai)
{
    return $nilai === "0" ? "Semua Pekerjaan" : "Status milik BPN";
}

function tanggalLahir($nilai)
{
    return date('d-M-Y', strtotime($nilai));
}

function tanggalFormat($nilai)
{
    return date('Y-m-d', strtotime($nilai));
}

function rupiah($nilai)
{
    return "Rp. " . number_format(ceil($nilai), "0", ",", ".");
}

function statusRawat($nilai)
{
    return ($nilai == 2) ? "Batal" : "Proses";
}

function namaKelas()
{
    $namaKelas = [
		1 => 'Kelas I',
		2 => 'Kelas II',
		3 => 'Kelas III'
    ];
    
    return $namaKelas;
}

function getNamaKelas($nilai)
{
    $namaKelas = [
		1 => 'Kelas I',
		2 => 'Kelas II',
		3 => 'Kelas III'
	];

	return $namaKelas[$nilai];
}

function jenisPelayanan($nilai)
{
    return $nilai == "1" ? "Rawat Inap" : "Rawat Jalan"; 
}

function noSurat($nilai)
{
    $arrNoSurat = explode("/", $nilai);
    return substr($arrNoSurat[0], -6);
}

function noReg($nilai)
{
	return substr($nilai, 0, 2);
}