<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { 
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); 
            min-height: 100vh; color: white; padding-top: 80px;
        }
        .navbar { background: linear-gradient(90deg, #667eea 0%, #764ba2 100%) !important; }
        .form-container {
            background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px);
            border-radius: 20px; padding: 30px; border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .form-control { background: rgba(255,255,255,0.2); border: none; color: white !important; }
        .btn-custom { background: linear-gradient(90deg, #4facfe 0%, #00f2fe 100%); color: white !important; border: none; font-weight: 600; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/">💼 E-Commerce Store</a>
            <div class="ms-auto d-flex align-items-center">
                <a href="{{ route('products.index') }}" class="nav-link text-white me-3">Batal</a>
                <form method="POST" action="{{ route('logout') }}">@csrf
                    <button type="submit" class="btn btn-sm btn-outline-light fw-bold">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="form-container">
                    <h2 class="fw-bold mb-4">📝 Edit Produk</h2>
                    
                    <form action="{{ route('products.update', $product->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">Nama Produk</label>
                            <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Harga (Rp)</label>
                            <input type="number" name="price" class="form-control" value="{{ $product->price }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Stok</label>
                            <input type="number" name="stock" class="form-control" value="{{ $product->stock }}" required>
                        </div>
                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-custom py-2 text-dark">Update Produk</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>