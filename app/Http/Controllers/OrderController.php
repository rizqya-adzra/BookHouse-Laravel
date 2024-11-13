<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\PDF;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Book;
use illuminate\Support\Facades\Auth;
use App\Exports\OrdersExport;
// use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $order = Order::where('name_customer')->simplePaginate(5);
        $order = Order::where('created_at', 'LIKE', '%'.$request->search.'%')->orderBy('created_at', 'DESC')->simplePaginate(5);
        return view('order.index', compact('order'));
        // dd($order);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $books = Book::all();
        return view('order.create', compact('books'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_customer' => 'required',
            'notes' => 'required',
            'books' => 'required',
        ], [
            'name_customer.required' => 'nama Wajib diisi!',
            'notes.required' => 'Catatan Wajib diisi!',
            'books.required' => 'Pembelian wajib diisi!',
        ]);

        $countDuplicate = array_count_values($request->books);
        $arrayFormat = [];

        foreach($countDuplicate as $key => $value) {
            $booksDetail = Book::find($key);

            if ($booksDetail['stock'] < $value) {
                $msg = 'Tidak dapat membeli Buku ' . $booksDetail['name'] . ' sisa stok: ' . $booksDetail['stock'];
                return redirect()->back()->withInput()->with('failed', $msg);
            }

            $booksFormat = [
                "id" => $key,
                "name_book" => $booksDetail['name'],
                "price" => $booksDetail['price'],
                "qty" => $value,    
                "sub_price" => $booksDetail['price'] * $value,
            ];

            array_push($arrayFormat, $booksFormat);
        }

        $totalPrice = 0;

        foreach($arrayFormat as $key => $value) {
            $totalPrice += $value['sub_price'];
        }

        $priceWithPPN = $totalPrice + ($totalPrice * 0.1);

        $addOrder = Order::create([
            'user_id' => Auth::user()->id,
            'books' => $arrayFormat,
            'name_customer' => $request->name_customer,
            'notes' => $request->notes,
            'total_price' => $priceWithPPN,
        ]);

        if($addOrder) {
            foreach($arrayFormat as $key => $value) {
                $lateStock = Book::find($value['id']);
                Book::where('id', $value['id'])->update([
                    'stock' =>($lateStock['stock'] - $value['qty'])
                ]);
            }
          return redirect()->route('pelanggan.order.print', $addOrder['id']);
        } else {
            return redirect()->back()->with('failed', 'Ada kesalahan dalam membeli obat');
            }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::find($id);
        return view('order.print', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function downloadPDF($id)
    {
        $order = Order::find($id)->toArray();
        view()->share('order', $order);
        $pdf = PDF::loadView('order.downloadpdf', $order);
        return $pdf->download('receipt.pdf');   
    }

    public function data(Request $request)
    {
        $orders = Order::with('user')->where('created_at', 'LIKE', '%'.$request->search.'%' )->orderBy('created_at', 'DESC')->simplePaginate(5);
        return view('order.admin.index', compact('orders'));
    }

    public function exportExcel()
    {
        $file_name = 'data_pembelian'.'.xlsx';
        return Excel::download(new OrdersExport, $file_name);
    }
}




