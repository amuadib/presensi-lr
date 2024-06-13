<div
    class="
                bg-white
                px-4
                py-3
                flex
                items-center
                justify-between
                border-t border-gray-200
                sm:px-6
                mt-2
              ">
    <div class="flex-1 flex justify-between sm:hidden">
        {{-- @if ($halaman['sekarang'] < $halaman['akhir']) --}}
        <a wire:click.prevent="prev()"
            class="
                  cursor-pointer
                  hover:text-green-500
                  relative
                  inline-flex
                  items-center
                  px-2
                  py-2
                  rounded-l-md
                  border border-gray-300
                  bg-white
                  text-sm
                  font-medium
                  text-gray-500
                  hover:bg-gray-50
                ">
            Prev
        </a>
        {{-- @else
            <a disabled
                class="
                            cursor-not-allowed
                  relative
                  inline-flex
                  items-center
                  px-2
                  py-2
                  rounded-l-md
                  border border-gray-300
                  bg-white
                  text-sm
                  font-medium
                  text-gray-500
                  hover:bg-gray-50
                ">
                Prev
            </a>
        @endif --}}

        {{-- @if ($halaman['sekarang'] > 1) --}}
        <a wire:click.prevent="next()"
            class="
                  cursor-pointer
                  hover:text-green-500
                  relative
                  inline-flex
                  items-center
                  px-2
                  py-2
                  rounded-r-md
                  border border-gray-300
                  bg-white
                  text-sm
                  font-medium
                  text-gray-500
                  hover:bg-gray-50
                ">
            Next
        </a>
        {{-- @else
            <a disabled
                class="
                            cursor-not-allowed
                  relative
                  inline-flex
                  items-center
                  px-2
                  py-2
                  rounded-r-md
                  border border-gray-300
                  bg-white
                  text-sm
                  font-medium
                  text-gray-500
                  hover:bg-gray-50
                "
                v-else>
                Next
            </a>
        @endif --}}
    </div>
    <div
        class="
                hidden
                sm:flex-1 sm:flex sm:items-center sm:justify-between
              ">
        <div>
            <p class="text-sm text-gray-700">
                @if ($tanggal != '-')
                    Terdapat {{ $halaman['total'] }} data Presensi pada Hari
                    {{ $tanggal }}
                @else
                    Hasil ke
                    <span class="font-medium">{{ $halaman['mulai'] + 1 }}</span>
                    sampai
                    <span class="font-medium">{{ $halaman['sampai'] }}</span>
                    dari
                    <span class="font-medium">{{ $halaman['total'] }}</span>
                    hasil
                @endif
            </p>
        </div>
        <div>
            <nav class="
                    relative
                    z-0
                    inline-flex
                    rounded-md
                    shadow-sm
                    -space-x-px
                  "
                aria-label="Pagination">
                <span wire:loading class="text-gray-500 text-sm p-2">loading...</span>
                {{-- @if ($halaman['sekarang'] < $halaman['akhir']) --}}
                <a wire:click.prevent="prev()"
                    class="
                      cursor-pointer
                      hover:text-green-500
                      relative
                      inline-flex
                      items-center
                      px-2
                      py-2
                      rounded-l-md
                      border border-gray-300
                      bg-white
                      text-sm
                      font-medium
                      text-gray-500
                      hover:bg-gray-50
                    ">
                    <i class="fa fa-chevron-left"></i>
                </a>
                {{-- @else
                                <a disabled
                                    class="
                                    cursor-not-allowed
                      relative
                      inline-flex
                      items-center
                      px-2
                      py-2
                      rounded-l-md
                      border border-gray-300
                      bg-white
                      text-sm
                      font-medium
                      text-gray-500
                      hover:bg-gray-50
                    ">
                                    <i class="fa fa-chevron-left"></i>
                                </a>
                            @endif --}}
                {{-- @if ($halaman['sekarang'] > 1) --}}
                <a wire:click.prevent="next()"
                    class="
                      cursor-pointer
                      hover:text-green-500
                      relative
                      inline-flex
                      items-center
                      px-2
                      py-2
                      rounded-r-md
                      border border-gray-300
                      bg-white
                      text-sm
                      font-medium
                      text-gray-500
                      hover:bg-gray-50
                    ">
                    <i class="fa fa-chevron-right"></i>
                </a>
                {{-- @else
                                <a disabled
                                    class="
                                    cursor-not-allowed
                      relative
                      inline-flex
                      items-center
                      px-2
                      py-2
                      rounded-r-md
                      border border-gray-300
                      bg-white
                      text-sm
                      font-medium
                      text-gray-500
                      hover:bg-gray-50
                    ">
                                    <i class="fa fa-chevron-right"></i>
                                </a>
                            @endif --}}
            </nav>
        </div>
    </div>
</div>
