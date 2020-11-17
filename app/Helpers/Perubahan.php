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
