<?php

function jenisKelamin($nilai)
{
    return $nilai === "L" ? "Laki-Laki" : "Perempuan";
}

function statusPekerjaan($nilai)
{
    return $nilai === 0 ? "Semua Pekerjaan" : "Status milik BPN";
}
