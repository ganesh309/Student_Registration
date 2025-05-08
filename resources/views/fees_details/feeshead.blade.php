@include('layouts.navbar')
<link href="{{ asset('css/fees-detail.css') }}" rel="stylesheet">

<div class="container" style="padding-top: 20px; margin-top: 80px; background-color: #86b7fe57;">
    <div class="d-flex justify-content-between align-items-center mb-4" style="border-bottom: 3px double #2c3e50; padding-bottom: 3px;">
        <h2 class="mx-auto mb-0" style="padding-left: 100px;">Fees Heads List</h2>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addFeesHeadModal">
            <i class="fas fa-plus-circle"></i> Add Fees Head
        </button>
    </div>

    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: '{{ session('success') }}',
                    confirmButtonColor: '#28a745'
                });
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: '{{ session('error') }}',
                    confirmButtonColor: '#dc3545'
                });
            });
        </script>
    @endif


    <div class="mb-3 d-flex justify-content-end align-items-center">
        <form method="GET" action="{{ route('fees-heads.list') }}" class="d-flex align-items-center" style="position: relative;">
            <div class="input-group">
                <input type="text" name="search" class="form-control"  style="border-radius: 4px;" placeholder="Search..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary"  style="border-radius: 4px;">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </form>
        <a href="{{ route('fees-heads.list') }}" class="btn btn-secondary ms-2" style="border-radius: 4px;">Reset</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover shadow-lg" style="margin-bottom: 10px;">
            <thead class="table-primary">
                <tr>
                    <th>ID</th>
                    <th>Actions</th>
                    <th>Name</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                @forelse($feesheads as $head)
                    <tr>
                        <td style="text-align: right;">{{ $loop->iteration }}</td>
                        <td>
                            <a href="javascript:void(0);" class="btn btn-warning btn-sm edit-btn"
                               data-id="{{ $head->id }}"
                               data-name="{{ $head->name }}"
                               data-description="{{ $head->description }}">
                                <i class="fas fa-edit"></i> Edit
                            </a>

                            @if($head->deletable)
                                <button type="button" class="btn btn-danger btn-sm delete-btn" data-id="{{ $head->id }}">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </button>

                                <form id="delete-form-{{ $head->id }}" action="{{ route('fees-heads.destroy', $head->id) }}" method="POST" style="display:none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            @endif


                        </td>
                        <td style="text-align: left;">{{ $head->name }}</td>
                        <td style="text-align: left;">{{ $head->description ?? 'N/A' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">No Fees Heads Found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Add Modal --}}
<div class="modal fade" id="addFeesHeadModal" tabindex="-1" aria-labelledby="addFeesHeadLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('fees-heads.store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Fees Head</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Fees Head Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Edit Modal --}}
<div class="modal fade" id="editFeesHeadModal" tabindex="-1" aria-labelledby="editFeesHeadLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" id="editFeesHeadForm">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Fees Head</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="edit-id">
                    <div class="mb-3">
                        <label for="edit-name" class="form-label">Fees Head Name</label>
                        <input type="text" name="name" id="edit-name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-description" class="form-label">Description</label>
                        <textarea name="description" id="edit-description" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Bootstrap + JS --}}
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/all.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const editButtons = document.querySelectorAll('.edit-btn');
        const editForm = document.getElementById('editFeesHeadForm');

        editButtons.forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                const name = this.getAttribute('data-name');
                const description = this.getAttribute('data-description');

                document.getElementById('edit-id').value = id;
                document.getElementById('edit-name').value = name;
                document.getElementById('edit-description').value = description;

                editForm.action = `/fees-heads/${id}`;
                let editModal = new bootstrap.Modal(document.getElementById('editFeesHeadModal'));
                editModal.show();
            });
        });
    });



    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById(`delete-form-${id}`).submit();
                    }
                });
            });
        });
    });

</script>


