<?php

namespace App\DataTables;

use App\Models\Client;
use Yajra\DataTables\Services\DataTable;

class ClientDatatable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Client $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Client $model)
    {
        return $model->newQuery()
                    ->select('id','nama_client','nik_client','alamat_client','jenis_kelamin','no_telepon');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns());
                 
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'id'         => ['name' => 'id', 'data' => 'id', 'title' => 'ID', 'orderable' => true, 'searchable' => false],
            'nik_client'       => ['name' => 'nik_client', 'data' => 'nik_client', 'title' => 'NIK CLIENT'],
            'nama_client'  => ['name' => 'nama_client', 'data' => 'nama_client', 'title' => 'NAMA CLIENT'],
            'alamat_client'  => ['name' => 'alamat_client', 'data' => 'alamat_client', 'title' => 'ALAMAT CLIENT'],
            'jenis_kelamin' => ['name' => 'jenis_kelamin', 'data' => 'jenis_kelamin', 'title' => 'KELAMIN'],
            'no_telepon' => ['name' => 'no_telepon', 'data' => 'no_telepon', 'title' => 'NO TELEPON']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Client_' . date('YmdHis');
    }
}
