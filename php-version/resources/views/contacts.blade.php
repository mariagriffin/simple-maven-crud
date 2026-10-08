<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phone Contacts Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-8">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">

        <h1 class="text-2xl font-bold mb-6 text-gray-800">Phone Directory</h1>

        @if(session('success'))
        <div class="mb-4 p-4 text-green-700 bg-green-100 rounded-lg">
            {{ session('success') }}
        </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">

            <form method="GET" action="{{ route('contacts.index') }}" class="flex gap-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name or phone..."
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Search</button>
                @if(request('search'))
                <a href="{{ route('contacts.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded-lg hover:bg-gray-500">Reset</a>
                @endif
            </form>

            <form method="POST" action="{{ route('contacts.store') }}" class="flex gap-2">
                @csrf
                <input type="text" name="name" placeholder="Name" required class="w-1/3 px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                <input type="tel"
                    name="phone"
                    placeholder="Phone Number"
                    pattern="[0-9]+"
                    inputmode="numeric"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                    required
                    class="w-1/3 px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"> <button type="submit" class="w-1/3 bg-green-600 text-white px-3 py-2 rounded-lg hover:bg-green-700">Add Number</button>
            </form>

        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-200 text-gray-700">
                        <th class="p-3">#</th>
                        <th class="p-3">Name</th>
                        <th class="p-3">Phone Number</th>
                        <th class="p-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($contacts as $contact)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-3">{{ $loop->iteration }}</td>
                        <td class="p-3 font-medium">{{ $contact->name }}</td>
                        <td class="p-3 text-gray-600">{{ $contact->phone }}</td>
                        <td class="p-3 text-center space-x-2 flex justify-center">

                            <button onclick="toggleEdit({{ $contact->id }})" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 text-sm">
                                Edit
                            </button>

                            <form method="POST" action="{{ route('contacts.destroy', $contact->id) }}"
                                onsubmit="return confirm('Are you sure you want to delete {{ $contact->name }}?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 text-sm">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>

                    <tr id="edit-row-{{ $contact->id }}" class="hidden bg-yellow-50 border-b">
                        <td colspan="4" class="p-3">
                            <form method="POST" action="{{ route('contacts.update', $contact->id) }}" class="flex gap-3 items-center">
                                @csrf
                                @method('PUT')
                                <input type="text" name="name" value="{{ $contact->name }}" required class="px-3 py-1 border rounded">
                                <input type="tel"
                                    name="phone"
                                    value="{{ $contact->phone }}"
                                    pattern="[0-9]+"
                                    inputmode="numeric"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                    required
                                    class="px-3 py-1 border rounded"> <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700 text-sm">Save</button>
                                <button type="button" onclick="toggleEdit({{ $contact->id }})" class="bg-gray-500 text-white px-3 py-1 rounded text-sm">Cancel</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="p-4 text-center text-gray-500">No contacts found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

    <script>
        function toggleEdit(id) {
            const editRow = document.getElementById(`edit-row-${id}`);
            editRow.classList.toggle('hidden');
        }
    </script>
</body>

</html>