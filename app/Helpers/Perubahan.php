<?php

function jenisKelamin($nilai)
{
    return $nilai === "L" ? "Laki-Laki" : "Perempuan";
}

function statusPekerjaan($nilai)
{
    return $nilai === 0 ? "Semua Pekerjaan" : "Status milik BPN";
}
function tanggalLahir($nilai)
{
    return date('d-M-Y', strtotime($nilai));
}

function rupiah($nilai)
{
    return "Rp. " . number_format(ceil($nilai), "0", ",", ".");
}
