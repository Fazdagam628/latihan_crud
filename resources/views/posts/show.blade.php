<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <nav class="navbar" style="background-color: #e3f2fd;" data-bs-theme="light">
        <div class="container col-md-12 d-flex justify-content-between">
            <a class="navbar-brand">POSTS</a>
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-md btn-danger mb-3">Logout</button>
            </form>
        </div>
    </nav>
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <img src="{{ asset('storage/posts/' . $post->image) }}" class="card-img-top" alt="Post Image">
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <h3>{{ $post->title }}</h3>
                        <hr />
                        <p>{{ 'Rp ' . number_format($post->price, 2, ',', '.') }}</p>
                        <code>
                            <p>{!! $post->description !!}</p>
                        </code>
                        <hr />
                        <p>Stock : {{ $post->stock }}</p>
                        <a href="{{ route('posts.index') }}" class="btn btn-md btn-primary mt-3 float-end">BACK TO
                            POSTS</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Message with sweetalert2
        @if(session('success'))
        Swal.fire({
            icon: "success",
            title: "BERHASIL!",
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 2000
        });
        @elseif(session('error'))
        Swal.fire({
            icon: "error",
            title: "GAGAL!",
            text: "{{ session('error') }}",
            showConfirmButton: false,
            timer: 2000
        });
        @endif
    </script>
</body>

</html>
