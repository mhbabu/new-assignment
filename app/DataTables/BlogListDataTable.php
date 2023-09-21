<?php

namespace App\DataTables;

use App\Models\Blog;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Str;
use Illuminate\Http\JsonResponse;


class BlogListDataTable extends DataTable
{

    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function ajax(): JsonResponse
    {
        return datatables()
            ->eloquent($this->query())
            ->editColumn('details', function ($data) {
                return Str::limit($data->details, 50, '...');
            })
            ->addColumn('action', function ($data) {
                $actionBtn = '<a href="/blogs/' . $data->id . '/edit/" class="btn btn-xs btn-primary btn-sm" title="Edit"> Edit</a> ';
                $actionBtn .= '<a href="/blogs/' . $data->id . '/delete/" class="btn btn-xs btn-danger btn-sm" title="Delete" onclick="return confirm(\'Are you sure you want to delete this item?\')"> Delete</a>';

                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }


    public function getBlogList()
    {
        $query = Blog::query();

        if (auth()->id() != 1) {
            // User ID - 1 is the System Admin who can see all the blogs.
            // Otherwise, users can see only their created blogs.
            $query->where('created_by', auth()->id());
        }

        return $query->latest();
    }

    /**
     * Get query source of dataTable.
     * @return \Illuminate\Database\Eloquent\Builder
     * @internal param \App\Models\AgentBalanceTransactionHistory $model
     */
    public function query()
    {
        return $this->applyScopes($this->getBlogList());
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->parameters([
                'dom' => 'Blfrtip',
                'responsive' => true,
                'autoWidth' => false,
                'paging' => true,
                "pagingType" => "full_numbers",
                'searching' => true,
                'info' => true,
                'searchDelay' => 350,
                "serverSide" => true,
                'order' => [[1, 'asc']],
                'pageLength' => 10,
                'lengthMenu' => [[10, 20, 25, 50, 100, 500, -1], [10, 20, 25, 50, 100, 500, 'All']],
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'name'      => ['data' => 'title', 'name' => 'title', 'orderable' => true, 'searchable' => true],
            'details'   => ['data' => 'details', 'name' => 'details', 'orderable' => true, 'searchable' => true],
            'action'    => ['searchable' => false]
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Blog_List_' . date('Y_m_d_H_i_s') . '.json';
    }
}
