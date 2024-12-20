<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Journal Collection</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: lightgray">

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
            <div>
                    <h3 class="text-center my-4">Journal Collection</h3>
                    <hr>
                </div>

                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <a href="{{ route('journals.create') }}" class="btn btn-md btn-success mb-3">ADD JOURNAL</a>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">TITLE</th>
                                    <th scope="col">AUTHOR</th>
                                    <th scope="col">PUBLISHER</th>
                                    <th scope="col">PUBLICATION DATE</th>
                                    <th scope="col">VOLUME</th>
                                    <th scope="col">ISSUE</th>
                                    <th scope="col">RESTRICTED ACCESS</th>
                                    <th scope="col" style="width: 20%">ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($journals as $journal)
                                    <tr>
                                        <td>{{ $journal->title }}</td>
                                        <td>{{ $journal->author }}</td>
                                        <td>{{ $journal->publisher }}</td>
                                        <td>{{ $journal->publication_date }}</td>
                                        <td>{{ $journal->volume ?? 'N/A' }}</td>
                                        <td>{{ $journal->issue ?? 'N/A' }}</td>
                                        <td>{{ $journal->restricted_access ? 'Yes' : 'No' }}</td>
                                        <td class="text-center">
                                            <form onsubmit="return confirm('Are you sure?');" action="{{ route('journals.destroy', $journal->id) }}" method="POST">
                                                <a href="{{ route('journals.show', $journal->id) }}" class="btn btn-sm btn-dark">SHOW</a>
                                                <a href="{{ route('journals.edit', $journal->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">DELETE</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">
                                            <div class="alert alert-danger">
                                                No journals available.
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $journals->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // message with sweetalert
        @if(session('success'))
            Swal.fire({
                icon: "success",
                title: "SUCCESS",
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @elseif(session('error'))
            Swal.fire({
                icon: "error",
                title: "FAILED",
                text: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @endif
    </script>

</body>
</html>
