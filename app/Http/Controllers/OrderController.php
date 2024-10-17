<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\PDF;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Book;
use illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $order = Order::where('name_customer')->simplePaginate(5);
        $order = Order::all();
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
            // 'nis' => 'required',
            // 'rombel' => 'required',
            'books' => 'required',
            'notes' => 'required',
        ]);

        $arrayDistinct = array_count_values($request->books);
        $arrayAssocBooks = [];

        foreach($arrayDistinct as $id => $count) {
            $books = Book::where('id', $id)->first();

            $subPrice = $books['price'] * $count;

            $arrayItem = [
                "id" => $id,
                "name_book" => $books['name'],
                "qty" => $count,    
                "price" => $books['price'],
                "sub_price" => $subPrice,
            ];

            array_push($arrayAssocBooks, $arrayItem);
        }

        $totalPrice = 0;

        foreach($arrayAssocBooks as $item) {
            $totalPrice += (int)$item['sub_price'];
        }

        $priceWithPPN = $totalPrice + ($totalPrice * 0.01);

        $proses = Order::create([
            'user_id' => Auth::user()->id,
            'name_customer' => $request->name_customer,
            'notes' => $request->notes,
            // 'nis' => $request->nis,
            // 'rombel' => $request->rombel,
            'books' => $arrayAssocBooks,
            'total_price' => $priceWithPPN,
        ]);

        if($proses) {
            $order = Order::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->first();
            return redirect()->route('pelanggan.order.print', $order['id']);
        } else {
            return redirect()->back()->with('error', 'Gagal Melakukan Pembelian');
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
}
