<x-app-layout>

    <x-slot name="header">
        <h2 class="font-bold text-3xl text-gray-900 dark:text-gray-100 leading-tight flex items-center gap-2">
            🍽 Menu List
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-gray-900 transition-colors duration-500">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Add Food Button -->
            <div class="flex justify-end mb-6">
                <a href="{{ route('food-menus.create') }}" 
                   class="inline-flex items-center px-5 py-3 bg-gradient-to-r from-green-500 to-green-600 text-white font-semibold rounded-xl shadow-lg hover:scale-105 hover:shadow-xl transition transform">
                    <span class="mr-2">➕</span> Add New Item
                </a>
            </div>

            <!-- Filters -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
                <input type="text" id="searchName" placeholder="🔍 Search by name"
                       class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-green-400 focus:outline-none shadow-sm transition">

                <select id="filterType" class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-green-400 focus:outline-none shadow-sm transition">
                    <option value="">All Types</option>
                    <option value="food">🍔 Food</option>
                    <option value="drink">🥤 Drink</option>
                </select>

                <select id="sortName" class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-green-400 focus:outline-none shadow-sm transition">
                    <option value="">Sort (Default)</option>
                    <option value="asc">A-Z</option>
                    <option value="desc">Z-A</option>
                </select>
            </div>

<!-- Table -->
<div class="overflow-x-auto bg-white dark:bg-gray-800 shadow-lg rounded-xl">
    <table id="foodMenuTable" class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 table-fixed">
        <colgroup>
            <col style="width:5%">   <!-- No -->
            <col style="width:10%">  <!-- Image -->
            <col style="width:20%">  <!-- Name -->
            <col style="width:10%">  <!-- Type -->
            <col style="width:35%">  <!-- Description -->
            <col style="width:10%">  <!-- Price -->
            <col style="width:10%">  <!-- Actions -->
        </colgroup>
        <thead class="bg-green-100 dark:bg-green-700">
            <tr>
                <th class="px-3 py-2 text-left text-xs font-semibold text-gray-700 dark:text-gray-200 uppercase tracking-wider">#</th>
                <th class="px-3 py-2 text-center text-xs font-semibold text-gray-700 dark:text-gray-200 uppercase tracking-wider">Image</th>
                <th class="px-3 py-2 text-left text-xs font-semibold text-gray-700 dark:text-gray-200 uppercase tracking-wider">Name</th>
                <th class="px-3 py-2 text-left text-xs font-semibold text-gray-700 dark:text-gray-200 uppercase tracking-wider">Type</th>
                <th class="px-3 py-2 text-left text-xs font-semibold text-gray-700 dark:text-gray-200 uppercase tracking-wider">Description</th>
                <th class="px-3 py-2 text-left text-xs font-semibold text-gray-700 dark:text-gray-200 uppercase tracking-wider">Price</th>
                <th class="px-3 py-2 text-center text-xs font-semibold text-gray-700 dark:text-gray-200 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
    </table>
</div>


        </div>
    </div>

@section('scripts')
<style>
/* DataTables modern styling */
.dataTables_length select {
    width: auto !important;
    display: inline-block !important;
    min-width: 70px;
    border-radius: 0.5rem;
}
.dataTables_wrapper .dataTables_paginate .paginate_button {
    padding: 0.35rem 0.75rem;
    margin-left: 0.25rem;
    border-radius: 0.5rem;
    border: 1px solid #d1d5db;
    transition: all 0.2s;
}
.dataTables_wrapper .dataTables_paginate .paginate_button.current {
    background-color: #10b981 !important;
    color: white !important;
    border: none;
}
.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
    background-color: #059669 !important;
    color: white !important;
}
table.dataTable tbody tr:hover {
    background-color: #f0fdf4 !important;
    cursor: pointer;
    transform: scale(1.01);
    transition: all 0.2s;
}

/* Scrollable text inside fixed column */
.scrollable-cell {
    max-width: 180px; /* adjust for Name column */
    max-width: 300px; /* adjust for Description column if needed */
    overflow-x: auto;  /* allow horizontal scroll */
    white-space: nowrap; /* keep text in single line */
    -webkit-overflow-scrolling: touch; /* smooth scroll on mobile */
    padding-right: 4px; /* small space for scrollbar */
}

/* Optional: hide scrollbar for Webkit (Chrome, Safari) */
.scrollable-cell::-webkit-scrollbar {
    height: 6px;
}
.scrollable-cell::-webkit-scrollbar-thumb {
    background-color: #10b981;
    border-radius: 3px;
}
.scrollable-cell::-webkit-scrollbar-track {
    background: #f0fdf4;
    border-radius: 3px;
}


</style>

<script>
$(document).ready(function(){
    let table = $('#foodMenuTable').DataTable({
        processing: true,
        serverSide: true,
        searching: false,
        ordering: false,
        lengthMenu: [ [10, 20, 50, 100], [10, 20, 50, 100] ],

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
    { data: 'id', name: 'id', className: 'text-left' },
    { 
        data: 'image_path', orderable:false, searchable:false, className: 'text-center',
        render: function(data){ 
            return data 
                ? `<img src="/storage/${data}" class="w-12 h-12 object-cover rounded-xl border border-gray-200 shadow-sm mx-auto">` 
                : '<span class="text-gray-400 italic">No Image</span>'; 
        }
    },
    { data: 'name', name: 'name', className: 'text-left', render: function(data){
        return `<div class="scrollable-cell">${data}</div>`;
    }},
    { data: 'type', name: 'type', className: 'text-left', render: function(data){
        return data === 'food' ? '🍔 Food' : '🥤 Drink';
    }},
    { data: 'description', name: 'description', className: 'text-left', render: function(data){
        if (!data) return ''; // if null or empty, show empty cell
        return `<div class="scrollable-cell max-w-[300px]">${data}</div>`;
    }},
    { data: 'price', name: 'price', className: 'text-left', render: function(data){ 
        return `RM ${parseFloat(data).toFixed(2)}`; 
    }},
    { 
        data: 'id', orderable:false, searchable:false, className: 'text-center',
        render: function(data,type,row){
            let csrf = '{{ csrf_token() }}';
            return `
                <div class="flex justify-center space-x-2">
                    <a href="/food-menus/${data}/edit" 
                       class="px-3 py-1 bg-blue-600 text-white rounded-xl hover:bg-blue-700 shadow transition text-sm flex items-center gap-1">
                       ✏️ Edit
                    </a>
                    <form action="/food-menus/${data}" method="POST" onsubmit="return confirm('Delete this item?');">
                        <input type="hidden" name="_token" value="${csrf}">
                        <input type="hidden" name="_method" value="DELETE">
                        <button class="px-3 py-1 bg-red-600 text-white rounded-xl hover:bg-red-700 shadow transition text-sm flex items-center gap-1">
                            🗑️ Delete
                        </button>
                    </form>
                </div>
            `;
        }
    }
]



    });

    $('#searchName,#filterType,#sortName').on('keyup change', function(){
        table.draw();
    });

    $('#foodMenuTable_length select').addClass('form-select form-select-sm');
});
</script>
@endsection

</x-app-layout>
