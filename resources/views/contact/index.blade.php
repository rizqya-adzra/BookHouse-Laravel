@extends('templates.app', ['title' => 'Contact Us'])
@section('dynamic-contents')
    <div class="d-flex m-auto justify-content-center mt-4 bg-warning"
        style="min-height: 600px; max-width: 1000px;">
        <div class="bg-danger" style="min-width: 400px; max-width:800px">
            <div class="p-5 bg-warning m-auto text-white" style="max-width: 300px; border-radius: 2px 2px 60px 60px">
                <h2 class="text-center">Contact Us!</h2>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Magni fugit ipsa quaerat est ipsam nemo
                    voluptate voluptas soluta veritatis repellat alias tenetur mollitia sed perspiciatis eveniet aliquid
                    commodi, aut asperiores.
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam quasi labore repudiandae quod</p>
                </div>
            </div>
            <form class="text-white bg-blue p-4 m-auto" style="border-radius: 5%" method="POST" enctype="multipart/form-data">
                @csrf
                <div>
                    <h1></h1>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="form-label">Nama Anda</label>
                        <input type="text" name="name" class="form-control mb-2" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label">Email Anda</label>
                        <input type="email" class="form-control mb-2" name="email" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Subjek</label>
                    <input type="text" class="form-control mb-2" name="sub" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Pesan</label>
                    <textarea class="form-control mb-2" name="mess" rows="10" required></textarea>
                </div>
                <div class="mt-3 text-center">
                    <button class="btn btn-danger" type="submit">Send Mail</button>
                </div>
            </form>
    </div>
@endsection
