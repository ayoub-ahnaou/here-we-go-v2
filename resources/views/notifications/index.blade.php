<x-app>
    <div class="container mx-auto px-2">
        <h1 class="text-2xl font-bold my-4">Notifications</h1>
        <ul>
            @forelse ($notifications as $notification)
                <li class="mb-2 p-4 border rounded flex flex-col gap-1">
                    {{-- {{ $notification->data['message'] }} --}}
                    <div class="flex items-center gap-2">
                        <img src="{{ $notification->data['image'] ? asset('storage/' . $notification->data['image']) : asset('assets/icons/profile.svg') }}"
                            alt="" class="size-5 rounded-full object-cover">
                        <span class="text-gray-600 text-sm"> {{ $notification->data['firstname'] }}
                            {{ $notification->data['lastname'] }} </span>
                    </div>
                    <p> {{ $notification->data['message'] }} </p>
                    <span class="text-xs text-gray-500">{{ $notification->created_at->diffForHumans() }}</span>
                </li>
            @empty
                <li>No new notifications</li>
            @endforelse
        </ul>
    </div>
</x-app>
