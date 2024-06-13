<x-app-layout>
    <div class="md:w-5/6 m-auto my-8">
        <div class="mt-10 sm:mt-0">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <div class="px-4 sm:px-0">
                        <h3 class="text-lg font-medium text-2xl leading-6 text-gray-900">
                            Profil
                        </h3>
                        <p class="mt-1 text-sm text-gray-600">{{ $user->authable->nama }}</p>
                    </div>
                </div>
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="bg-gradient-to-l from-pink-600 to-purple-700 p-3 text-white text-center">
                            <div class="md:flex-shrink-0">
                                <img src="{{ url('/wajah/' . $user->authable->foto) }}"
                                    class="w-16 h-16 rounded-full mx-auto bg-white p-0.5 border-2 border-white" />
                            </div>
                            <div class="mb-2">
                                <div class="text-xl font-bold">
                                    {{ $user->authable->nama }}
                                </div>
                                <div class="text-sm">No HP: {{ $user->authable->hp }}</div>
                            </div>
                            @if ($user->authable->unit)
                                <div class="-mb-1">
                                    <i class="fa fa-award"></i>
                                    {{ strtoupper($user->authable->unit->nama ?? '') }}
                                </div>
                            @endif
                        </div>
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <div class="mb-2 text-gray-500">
                                @if (count($jam) > 0)
                                    <table
                                        class="items-center w-full bg-transparent border-collapse border border-gray-500">
                                        <thead>
                                            <tr class="border-b border-gray-500">
                                                <th
                                                    class="px-6 bg-gray-100 text-gray-600 align-middle py-1 text-sm uppercase border-l-0 border-r-0 whitespace-no-wrap font-semibold text-left">
                                                    Hari
                                                </th>
                                                @foreach ($jam as $j)
                                                    <th
                                                        class="px-6 bg-gray-100 text-gray-600 align-middle py-1 text-sm uppercase border-l-0 border-r-0 whitespace-no-wrap font-semibold text-left">
                                                        {{ $j[0]['nama'] }}
                                                    </th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach (config('custom.hari') as $k => $v)
                                                <tr class="odd:bg-gray-50">
                                                    <th
                                                        class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-no-wrap text-left @if ($k == date('w')) text-black @endif">
                                                        {{ $v }}
                                                    </th>
                                                    @foreach ($jam as $j)
                                                        <td
                                                            class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-no-wrap @if ($k == date('w')) text-black @endif">
                                                            {{ $j[$k]['waktu'] }}
                                                        </td>
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                            <div class="mb-2">
                                <i class="fa fa-id-badge"></i>
                                Data Pengguna
                            </div>
                            <div class="mb-2">
                                <div class="mb-2">
                                    <div>
                                        <label class="block font-medium text-sm text-gray-700" for="nik">
                                            NIK
                                        </label>
                                        {{ $user->authable->nik }}
                                    </div>
                                    <div>
                                        <label class="block font-medium text-sm text-gray-700" for="nik">
                                            Nama
                                        </label>
                                        {{ $user->authable->nama }}
                                    </div>
                                    <div>
                                        <label class="block font-medium text-sm text-gray-700" for="nik">
                                            Tempat, Tanggal Lahir
                                        </label>
                                        {{ $user->authable->tempat_lahir }},
                                        {{ formatTanggal($user->authable->tanggal_lahir) }}
                                    </div>
                                    <div>
                                        <label class="block font-medium text-sm text-gray-700" for="nik">
                                            Jenis Kelamin
                                        </label>
                                        @if ($user->authable->jenis_kelamin == 'l')
                                            Laki-laki
                                        @else
                                            Perempuan
                                        @endif
                                    </div>
                                    <div>
                                        <label class="block font-medium text-sm text-gray-700" for="nik">
                                            Alamat
                                        </label>
                                        {{ $user->authable->alamat }}
                                    </div>
                                    <div>
                                        <label class="block font-medium text-sm text-gray-700" for="nik">
                                            Status Sipil
                                        </label>
                                        {{ config('custom.status_sipil')[$user->authable->status] }}
                                    </div>
                                    <div>
                                        <label class="block font-medium text-sm text-gray-700" for="nik">
                                            Nomor HP
                                        </label>
                                        {{ $user->authable->hp }}
                                    </div>
                                    <div>
                                        <label class="block font-medium text-sm text-gray-700" for="nik">
                                            Email
                                        </label>
                                        {{ $user->authable->email }}
                                    </div>
                                </div>
                                <a href="{{ route('profile.edit') }}"
                                    class="inline-flex items-center px-1 md:px-2 md:py-1 border border-transparent rounded shadow-sm text-xs font-medium text-gray-700 bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-1 focus:ring-offset-2 focus:ring-indigo-500">
                                    Edit
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
