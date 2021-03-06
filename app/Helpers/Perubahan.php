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

function tanggalNilai($nilai)
{
    return date("N", strtotime($nilai)) + 1;
}

function tanggalIndo($nilai)
{
    return date('d-m-Y', strtotime($nilai));
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

function tipeRujukan($nilai)
{
    $tipe = [
        0 => "Rujukan Penuh",
        1 => "Rujukan Partial",
        2 => "Rujukan Balik"
    ];
    return $tipe[$nilai];
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

function getKodeAsalRujukan($nilai)
{
    return substr($nilai, 0, 8);
}

function listRole()
{
    return [
        'admin' => 'Admin',
        'operator' => 'Operator',
    ];
}

function getKelas($nilai)
{
    $kelas = [
        1 => 'KL1',
        2 => 'KL2',
        3 => 'KL3',
        4 => 'VIP',
        6 => 'NON',
        10 => 'ICU',
        11 => 'NON',
        13 => 'SAL',
        14 => 'NIC',
        15 => 'PIC',
        16 => 'ISO',
        17 => 'HCU',
        18 => 'NON',
        19 => 'HCU',
        20 => 'ICU'
    ];

    return $kelas[$nilai];
}

function gantiKata($nilai)
{
    return str_replace('Ruang ', '', $nilai);
}