<?php

function jenisKelamin($nilai) {
    return $nilai === "L" ? "Laki-Laki" : "Perempuan";
}

function tanggalLahir($nilai) {
    return date('d-M-Y', strtotime($nilai));
}

function rupiah($nilai)
{
	return "Rp. " . number_format(ceil($nilai), "0", ",", ".");
}
