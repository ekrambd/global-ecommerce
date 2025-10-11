<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Order;
use App\Models\Orderdetail;
use DataTables;

class OrderController extends Controller
{   

	public function __construct()
    {
        $this->middleware('auth_check');
    }

    public function orderLists(Request $request)
    {
    	if ($request->ajax()) {
            $orders = Orderdetail::latest();

            return DataTables::of($orders)
                ->addIndexColumn()

                ->addColumn('serial', function ($row) {
                	return $row->id;
                })
                
                ->addColumn('status', function ($row) {
                    return $row->status;
                })

                ->addColumn('action', function ($row) {
                    $viewUrl = url('/')."/show-order/".$row->id;

                    return '
                        <a href="' . $viewUrl . '" 
                           class="btn btn-primary btn-sm action-button view-order" 
                           data-id="' . $row->id . '">
                            <i class="fa fa-eye"></i>
                        </a>
                        &nbsp;
                        <button type="button" 
                           class="btn btn-danger btn-sm delete-order action-button" 
                           data-id="' . $row->id . '">
                            <i class="fa fa-trash"></i>
                        </button>
                    ';
                })

                ->rawColumns(['status', 'action','serial'])
                ->make(true);
        }

        return view('orders.order_lists');
    }

    public function showOrder($id)
    {
    	$data = Orderdetail::with('orders.product')->findorfail($id);
    	return view('orders.show_invoice', compact('data'));
    }
}
