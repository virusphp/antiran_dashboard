<?php

function jenisKelamin($nilai)
{
    return $nilai === "L" ? "Laki-Laki" : "Perempuan";
}

function statusPekerjaan($nilai)
{
    return $nilai === 1 ? "Semua Pekerjaan" : "Status milik BPN";
}
