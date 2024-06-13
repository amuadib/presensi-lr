<div>
    @if ($mode == '')
        <div class="md:w-5/6 m-auto my-3 md:my-8 shadow-lg">
            <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 rounded">
                <div class="rounded-t mb-0 px-4 py-3 border-0">
                    <div class="flex flex-wrap items-center">
                        <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                            <h3 class="font-semibold text-gray-800 text-2xl">Unit Kerja</h3>
                        </div>
                        @if ($mode == '')
                            <div class="relative w-full px-4 max-w-full flex-grow flex-1 text-right">
                                <button type="button" wire:click.prevent="create()"
                                    class="cursor-pointer bg-indigo-500 text-white active:bg-indigo-600 hover:bg-indigo-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">
                                    TAMBAH
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="block w-full overflow-x-auto">
                    <table class="items-center w-full bg-transparent border-collapse">
                        <thead>
                            <tr>
                                <th
                                    class="px-6 bg-gray-100 text-gray-600 align-middle border border-solid border-gray-200 py-3 text-sm uppercase border-l-0 border-r-0 whitespace-no-wrap font-semibold text-left">
                                    Nama
                                </th>
                                <th
                                    class="px-6 bg-gray-100 text-gray-600 align-middle border border-solid border-gray-200 py-3 text-sm uppercase border-l-0 border-r-0 whitespace-no-wrap font-semibold text-left">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!$data->count())
                                <tr>
                                    <td colspan="4"
                                        class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-no-wrap p-4 text-center">
                                        Belum ada data
                                    </td>
                                </tr>
                            @else
                                @foreach ($data as $u)
                                    <tr>
                                        <td
                                            class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-no-wrap p-4 text-left">
                                            {{ $u->nama }}
                                        </td>
                                        <td
                                            class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-no-wrap p-4">
                                            <button type="button" wire:click.prevent="edit({{ $u->id }})"
                                                class="inline-flex items-center px-1 md:px-2 md:py-1 border border-transparent rounded shadow-sm text-xs font-medium text-gray-700 bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-1 focus:ring-offset-2 focus:ring-indigo-500">
                                                Edit
                                            </button>
                                            <button type="button"
                                                wire:click="$emit('confirmDelete', {{ $u->id }})"
                                                class="inline-flex items-center px-1 md:px-2 md:py-1 border border-transparent rounded shadow-sm text-xs font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-1 focus:ring-offset-2 focus:ring-indigo-500">
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    @else
        @include('livewire.unit-kerja.form')
    @endif
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.livewire.on('confirmDelete', dataId => {
                if (confirm('Apakah Anda yakin akan menghapus data ini?')) {
                    @this.call('destroy', dataId)
                }
            });
        });
    </script>
</div>
