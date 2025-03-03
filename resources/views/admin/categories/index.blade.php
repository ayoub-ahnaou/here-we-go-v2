<x-dashboard>
    <!-- Modal Structure -->
    <div id="addCategoryModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded-lg p-6 w-full max-w-md">
            <h3 class="text-lg font-medium text-gray-800 mb-4">Add New Category</h3>
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" id="name" name="name"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea id="description" name="description"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="closeModal()"
                        class="mr-2 px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200">
                        Cancel
                    </button>
                    <button type="submit"
                        class="px-4 py-2 text-sm font-medium text-white bg-gray-600 rounded-md hover:bg-gray-700">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Dashboard Content -->
    <div class="flex flex-col md:flex-row items-center justify-between mb-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4 md:mb-0">Categories</h2>
    </div>

    <div class="bg-white shadow-md rounded-sm overflow-hidden">
        <div class="px-4 py-5 border-b border-gray-200 flex items-center justify-between">
            <h3 class="text-lg font-medium text-gray-800">List of categories</h3>

            <p onclick="openModal()"
                class="flex cursor-pointer items-center gap-1 bg-gray-50 hover:bg-gray-100 px-4 py-1 rounded-full">
                <span class="text-xs text-gray-600">Add new category</span>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 8v8M8 12h8" stroke="gray" />
                </svg>
            </p>
        </div>

        <div class="overflow-x-auto">
            @if (sizeof($categories) == 0)
                <p class="text-red-500 p-2 text-sm">No categories available</p>
            @else
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                ID
                            </th>
                            <th scope="col"
                                class="px-6 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Name
                            </th>
                            <th scope="col"
                                class="px-6 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Description
                            </th>
                            <th scope="col"
                                class="px-6 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($categories as $category)
                            <tr>
                                <td class="px-6 py-1 text-xs whitespace-nowrap text-gray-500">#{{ $category->id }}</td>
                                <td class="px-6 py-1 text-xs whitespace-nowrap text-gray-900">{{ $category->name }}</td>
                                <td class="px-6 py-1 text-xs whitespace-nowrap text-gray-900">
                                    {{ $category->description }}
                                </td>
                                <td class="px-6 py-1 text-xs whitespace-nowrap text-gray-500">
                                    <div class="flex space-x-2">
                                        <form action="{{ route('categories.destroy', $category) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-700 underline">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</x-dashboard>

<script>
    function openModal() {
        document.getElementById('addCategoryModal').classList.remove('hidden');
        document.querySelector('x-dashboard').classList.add('blur-background');
    }

    function closeModal() {
        document.getElementById('addCategoryModal').classList.add('hidden');
        document.querySelector('x-dashboard').classList.remove('blur-background');
    }

    // Close modal when clicking outside of it
    window.onclick = function(event) {
        const modal = document.getElementById('addCategoryModal');
        if (event.target === modal) {
            closeModal();
        }
    };
</script>

<style>
    .blur-background {
        filter: blur(4px);
    }
</style>
