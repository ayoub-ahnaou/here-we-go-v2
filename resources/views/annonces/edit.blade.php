<x-app>
    <div id="addAnnouncementModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="w-full max-w-4xl bg-white rounded-2xl shadow-xl overflow-hidden text-sm">

            <form class="p-6 md:p-8 space-y-6" method="POST" action="{{ route('my-annonces.update', $annonce->id) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                {{-- {/* Image Upload */} --}}
                <div class="flex items-center gap-2 w-full">
                    <div
                        class="relative border-2 border-dashed border-gray-300 rounded-xl p-2 transition-all hover:border-gray-500 group w-5/6">
                        <input type="file" name="images" id="images"
                            value="{{ asset('storage/' . $annonce->images) }}"
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" />
                        <div class="flex flex-col items-center justify-center space-y-3">
                            <div
                                class="p-3 bg-blue-50 rounded-full text-gray-500 group-hover:bg-blue-100 transition-all">
                                <Image class="w-8 h-8" />
                            </div>
                            <p class="text-gray-700 font-medium">Drag and drop your images here</p>
                            <p class="text-sm text-gray-500">or click to browse files</p>
                        </div>
                    </div>
                    <div class="h-full w-1/6">
                        @if ($annonce->images)
                            <img src="{{ asset('storage/' . $annonce->images) }}" alt="Current Image"
                                class="w-32 h-32 object-cover rounded">
                        @else
                            <p>No image uploaded.</p>
                        @endif
                    </div>
                </div>

                {{-- {/* Location */} --}}
                <div class="bg-gray-50 p-5 rounded-xl space-y-4">
                    <div class="flex items-center space-x-2 text-gray-700 mb-2">
                        <MapPin class="w-5 h-5 text-gray-500" />
                        <h3 class="font-medium">Location</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="country" class="block text-sm font-medium text-gray-700 mb-1">
                                Country
                            </label>
                            <input type="text" id="country" name="country" value="{{ $annonce->country }}"
                                class="w-full p-1 pl-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-gray-500 focus:border-transparent transition-all outline-none"
                                placeholder="Enter country" />
                        </div>
                        <div>
                            <label for="city" class="block text-sm font-medium text-gray-700 mb-1">
                                City
                            </label>
                            <input type="text" id="city" name="city" value="{{ $annonce->city }}"
                                class="w-full p-1 pl-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-gray-500 focus:border-transparent transition-all outline-none"
                                placeholder="Enter city" />
                        </div>
                    </div>
                </div>

                {{-- {/* Basic Details */} --}}
                <div class="space-y-4">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">
                            Title
                        </label>
                        <input type="text" id="title" name="title" value="{{ $annonce->title }}"
                            class="w-full p-1 pl-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-gray-500 focus:border-transparent transition-all outline-none"
                            placeholder="Enter a catchy title" />
                    </div>

                    <div>
                        <label for="disponibility" class="block text-sm font-medium text-gray-700 mb-1">
                            Availability Date
                        </label>
                        <div class="relative">
                            <input type="date" id="disponibility" name="disponibility"
                                value="{{ $annonce->disponibility }}"
                                class="w-full p-1 pl-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-gray-500 focus:border-transparent transition-all outline-none" />
                            <Calendar class="absolute right-3 top-3 w-5 h-5 text-gray-400 pointer-events-none" />
                        </div>
                    </div>
                </div>

                {{-- {/* Description and Equipment */} --}}
                <div>
                    <label for="equipements" class="flex items-center text-sm font-medium text-gray-700 mb-1">
                        <Briefcase class="w-4 h-4 mr-1 text-gray-500" />
                        Equipment
                    </label>
                    <textarea id="equipements" name="equipements" rows={5}
                        class="w-full p-1 pl-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-gray-500 focus:border-transparent transition-all outline-none resize-none"
                        placeholder="List available equipment, separate with comma">{{ $annonce->equipements }}</textarea>
                </div>

                {{-- {/* Category and Price */} --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="category_id" class="flex items-center text-sm font-medium text-gray-700 mb-1">
                            <Tag class="w-4 h-4 mr-1 text-gray-500" />
                            Category
                        </label>
                        <select id="category_id" name="category_id"
                            class="w-full p-1 pl-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-gray-500 focus:border-transparent transition-all outline-none appearance-none bg-white">
                            <option value="" disabled selected>
                                Select a category
                            </option>
                            @foreach ($categories as $category)
                                <option {{ $annonce->category->id == $category->id ? 'selected' : '' }}
                                    value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="price" class="flex items-center text-sm font-medium text-gray-700 mb-1">
                            <DollarSign class="w-4 h-4 mr-1 text-gray-500" />
                            Price
                        </label>
                        <div class="relative">
                            <input type="number" id="price" name="price" value="{{ $annonce->price }}"
                                class="w-full pl-10 rounded-lg border border-gray-300 focus:ring-2 focus:ring-gray-500 focus:border-transparent transition-all outline-none"
                                placeholder="0.00" />
                            <span class="absolute left-3 top-3 text-gray-500">DH</span>
                        </div>
                    </div>
                </div>

                {{-- {/* Action Buttons */} --}}
                <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-3 pt-4">
                    @csrf
                    @method('PUT')

                    <a href="{{ route('annonces.myannonces') }}" type="button"
                        class="px-6 py-3 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-200 transition-all">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-6 py-3 text-white bg-gradient-to-r from-gray-500 to-gray-900 rounded-lg hover:from-gray-500 hover:to-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all">
                        Publish Announcement
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app>
