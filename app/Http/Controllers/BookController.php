<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $books = Book::where('name', 'LIKE', '%'.$request->search.'%')->orderBy('stock', 'ASC')->simplePaginate(5);
        return view('book.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('book.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'author' => 'required',
            'publisher' => 'required',
            'publish' => 'required|numeric',
            'price' => 'required|numeric',
            'stock' => 'required|numeric|min:1',
        ],

        [
            'name.required' => 'Judul Buku Wajib diisi!',
            'type.required' => 'Tipe Buku Wajib diisi!',
            'author.required' => 'Penulis Wajib diisi!',
            'publisher.required' => 'Penerbit Buku Wajib diisi!',
            'publish.required' => 'Tahun Terbit Wajib diisi!',
            'price.required' => 'Harga Wajib diisi!',
            'stock.required' => 'Stok Tersedia Wajib diisi!',
            'stock.min' => 'Stok Minimal 1!',
        ]
    );

        $proses = Book::create([
            'name' => $request->name,
            'type' => $request->type,
            'author' => $request->author,
            'publisher' => $request->publisher,
            'publish' => $request->publish,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);

        if ($proses) {
            return redirect()->route('books')->with('success', 'Data Buku berhasil ditambahkan!');
        } else {
            return redirect()->route('books.add')->with('failed', 'Data Buku gagal ditambahkan!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $books = Book::find($id);
        return view('book.edit', compact('books'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'author' => 'required',
            'publisher' => 'required',
            'publish' => 'required|numeric',
            'price' => 'required|numeric',
            'stock' => 'required|numeric|min:1',
        ],

        [
            'name.required' => 'Judul Buku Wajib diisi!',
            'type.required' => 'Tipe Buku Wajib diisi!',
            'author.required' => 'Penulis Wajib diisi!',
            'publisher.required' => 'Penerbit Buku Wajib diisi!',
            'publish.required' => 'Tahun Terbit Wajib diisi!',
            'price.required' => 'Harga Wajib Diisi!',
            'stock.required' => 'Stok Tersedia Wajib diisi!',
            'stock.min' => 'Stok Minimal 1!',
        ]
    );

        $proses = Book::where('id', $id)->update([
            'name' => $request->name,
            'type' => $request->type,
            'author' => $request->author,
            'publisher' => $request->publisher,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);

        if ($proses) {
            return redirect()->route('books')->with('success', 'Berhasil Mengubah Data Buku!');
        } else {
            return redirect()->route('books.add')->with('failed', 'Gagal Mengubah Data Buku!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $proses = Book::where('id', $id)->delete();

        if ($proses) {
            return redirect()->back()->with('success', 'Data Berhasil Dihapus!');
        } else {
            return redirect()->back()->with('failed', 'Data Gagal Dihapus!'); 
        }
    }

    public function downloadPDF()
    {
        $books = Book::all()->toArray();
        view()->share('books', $books);
        $pdf = PDF::loadView('book.print', $books);
        return $pdf->download('receipt.pdf');   
    }
}
