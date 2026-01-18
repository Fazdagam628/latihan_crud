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
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <h3 class="text-center my-4">Products Table</h3>
                    <hr>
                </div>
                <div class="card border-0 shadow-lg rounded">
                    <div class="card-body">
                        <a href="{{ route('posts.create') }}" class="btn btn-md btn-success mb-3">ADD POST</a>
                        <table class="table tabled-bordered">

                            <thead>
                                <tr>
                                    <th scope="col">IMAGE</th>
                                    <th scope="col">TITLE</th>
                                    <th scope="col">PRICE</th>
                                    <th scope="col">STOCK</th>
                                    <th scope="col" style="width: 20%">ACTIONS</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($posts as $post)
                                <tr>
                                    <td><img src="{{ asset('storage/posts/' . $post->image) }}" width="70px"
                                            alt="Image"></td>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ 'Rp ' . number_format($post->price, 2, ',', '.') }}</td>
                                    <td>{{ $post->stock }}</td>
                                    <td>
                                        <a href="{{ route('posts.show', $post->id) }}"
                                            class="btn btn-sm btn-primary">SHOW</a>
                                        <a href="{{ route('posts.edit', $post->id) }}"
                                            class="btn btn-sm btn-warning">EDIT</a>
                                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure to delete this post?')">DELETE</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <div class="alert alert-danger">
                                    Data produk belum ada.
                                </div>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $posts->links() }}
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
