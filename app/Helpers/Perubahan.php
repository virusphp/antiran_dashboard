<?php

function jenisKelamin($nilai) {
    return $nilai === "L" ? "Laki-Laki" : "Perempuan";
}

function rupiah($nilai)
{
	return "Rp. " . number_format(ceil($nilai), "0", ",", ".");
}