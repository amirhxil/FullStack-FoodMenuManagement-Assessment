<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Food Menu
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <a href="{{ route('food-menus.create') }}" class="btn btn-success mb-3">
                Add Food
            </a>

            <!-- Filters -->
            <div class="row mb-3">
                <div class="col-md-3">
                    <input type="text" id="searchName" class="form-control" placeholder="Search name">
                </div>
                <div class="col-md-3">
                    <select id="filterType" class="form-control">
                        <option value="">All Types</option>
                        <option value="food">Food</option>
                        <option value="drink">Drink</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select id="sortName" class="form-control">
                        <option value="">Sort Name</option>
                        <option value="asc">A-Z</option>
                        <option value="desc">Z-A</option>
                    </select>
                </div>
            </div>

            <table id="foodMenuTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>

        </div>
    </div>

@section('scripts')
<script>
$(document).ready(function(){
    let table = $('#foodMenuTable').DataTable({
        processing: true,
        serverSide: true,
    searching: false,   // remove global search box
    ordering: false,        // disable column sort arrows

        ajax: {
    url: "{{ route('food-menus.data') }}",


            data: function (d) {
                d.searchName = $('#searchName').val();
                d.filterType = $('#filterType').val();
                d.sortName = $('#sortName').val();
            },

            error: function (xhr) {
                if (xhr.status === 401) {
                    alert("Session expired. Please login again.");
                    window.location.href = "/login";
                }
            }
        },

        columns: [
            { data: 'id', name: 'id' },
            { 
                data: 'image_path', orderable:false, searchable:false,
                render: function(data){ return data ? `<img src="/storage/${data}" width="50">` : ''; }
            },
            { data: 'name', name: 'name' },
            { data: 'type', name: 'type' },
            { data: 'description', name: 'description' },
            { data: 'price', name: 'price' },
            { 
                data: 'id', orderable:false, searchable:false,
                render: function(data,type,row){
                    let csrf = '{{ csrf_token() }}';
                    return `
                        <a href="/food-menus/${data}/edit" class="btn btn-primary btn-sm">Edit</a>
                        <form action="/food-menus/${data}" method="POST" style="display:inline;">
                            <input type="hidden" name="_token" value="${csrf}">
                            <input type="hidden" name="_method" value="DELETE">
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Delete?')">Delete</button>
                        </form>
                    `;
                }
            }
        ]
    });

    $('#searchName,#filterType,#sortName').on('keyup change', function(){
        table.draw();
    });
});
</script>
@endsection


</x-app-layout>
