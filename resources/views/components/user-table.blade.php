<table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md mb-4">
    <thead class="bg-gray-100 text-gray-600">
        <tr>
            <th class="px-4 py-2 text-left">Nama</th>
            <th class="px-4 py-2 text-left">Email</th>
            <th class="px-4 py-2 text-left">Role</th>
            <th class="px-4 py-2 text-left">Akses</th>
            <th class="px-4 py-2 text-left">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($users as $user)
            <tr class="border-t border-gray-200">
                <td class="px-4 py-2 text-gray-800">{{ $user->nama }}</td>
                <td class="px-4 py-2 text-gray-700">{{ $user->email }}</td>
                <td class="px-4 py-2 capitalize text-gray-700">
                    {{ $user->primaryRole ? $user->primaryRole->name : '-' }}

                </td>
                <td class="px-4 py-2">
                    <span class="px-3 py-1 text-sm rounded-full {{ $user->akses === 'on' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $user->akses === 'on' ? 'Aktif' : 'Nonaktif' }}
                    </span>
                </td>
                <td class="px-4 py-2 flex gap-2">
                    <form method="POST" action="{{ route('admin.users.toggleAkses', ['id_user' => $user->id]) }}">
                        @csrf
                        <button class="px-3 py-1 text-sm rounded {{ $user->akses === 'on' ? 'bg-red-500' : 'bg-green-500' }} text-white">
                            {{ $user->akses === 'on' ? 'Nonaktifkan' : 'Aktifkan' }}
                        </button>
                    </form>

                    <form method="POST" action="{{ route('admin.users.changeRole', ['id_user' => $user->id]) }}">
                        @csrf
                        <button class="px-3 py-1 text-sm bg-yellow-500 text-white rounded hover:bg-yellow-600">
                            Jadikan {{ $user->primaryrole && $user->primaryrole->name === 'warga' ? 'Satpam' : 'Warga' }}
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="px-4 py-2 text-center text-gray-500">Tidak ada pengguna.</td>
            </tr>
        @endforelse
    </tbody>
</table>
