<div
    class="
          grid
          md:grid-cols-4 md:w-5/6
          m-auto
          mt-3
          md:mt-5
          gap-4
          grid-cols-2
        ">
    <div class="">
        <div
            class="
              relative
              flex flex-col
              min-w-0
              break-words
              bg-white
              rounded
              mb-6
              xl:mb-0
              shadow
            ">
            <div class="flex-auto p-4">
                <div class="flex flex-wrap">
                    <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                        <h5 class="text-gray-500 uppercase font-bold text-sm">
                            HADIR
                        </h5>
                        <span class="font-semibold text-xl text-gray-800">
                            {{ $hadir['jml'] ?? 0 }}
                        </span>
                    </div>
                    <div class="relative w-auto pl-4 flex-initial">
                        <div
                            class="
                      text-white
                      p-3
                      text-center
                      inline-flex
                      items-center
                      justify-center
                      w-12
                      h-12
                      shadow-lg
                      rounded-full
                      bg-green-500
                    ">
                            <i class="fa fa-user-check"></i>
                        </div>
                    </div>
                </div>
                <p class="text-sm text-gray-500 mt-4">{!! persenan($hadir['bl']) !!}</p>
            </div>
        </div>
    </div>
    <div class="">
        <div
            class="
              relative
              flex flex-col
              min-w-0
              break-words
              bg-white
              rounded
              mb-6
              xl:mb-0
              shadow
            ">
            <div class="flex-auto p-4">
                <div class="flex flex-wrap">
                    <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                        <h5 class="text-gray-500 uppercase font-bold text-sm">
                            SAKIT
                        </h5>
                        <span class="font-semibold text-xl text-gray-800">
                            {{ $sakit['jml'] ?? 0 }}
                        </span>
                    </div>
                    <div class="relative w-auto pl-4 flex-initial">
                        <div
                            class="
                      text-white
                      p-3
                      text-center
                      inline-flex
                      items-center
                      justify-center
                      w-12
                      h-12
                      shadow-lg
                      rounded-full
                      bg-yellow-500
                    ">
                            <i class="fa fa-procedures"></i>
                        </div>
                    </div>
                </div>
                <p class="text-sm text-gray-500 mt-4">{!! persenan($sakit['bl']) !!}</p>
            </div>
        </div>
    </div>
    <div class="">
        <div
            class="
              relative
              flex flex-col
              min-w-0
              break-words
              bg-white
              rounded
              mb-6
              xl:mb-0
              shadow
            ">
            <div class="flex-auto p-4">
                <div class="flex flex-wrap">
                    <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                        <h5 class="text-gray-500 uppercase font-bold text-sm">
                            IZIN
                        </h5>
                        <span class="font-semibold text-xl text-gray-800">
                            {{ $izin['jml'] ?? 0 }}
                        </span>
                    </div>
                    <div class="relative w-auto pl-4 flex-initial">
                        <div
                            class="
                      text-white
                      p-3
                      text-center
                      inline-flex
                      items-center
                      justify-center
                      w-12
                      h-12
                      shadow-lg
                      rounded-full
                      bg-indigo-500
                    ">
                            <i class="fa fa-envelope"></i>
                        </div>
                    </div>
                </div>
                <p class="text-sm text-gray-500 mt-4">{!! persenan($izin['bl']) !!}</p>
            </div>
        </div>
    </div>
    <div class="">
        <div
            class="
              relative
              flex flex-col
              min-w-0
              break-words
              bg-white
              rounded
              mb-6
              xl:mb-0
              shadow
            ">
            <div class="flex-auto p-4">
                <div class="flex flex-wrap">
                    <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                        <h5 class="text-gray-500 uppercase font-bold text-sm">
                            TERLAMBAT
                        </h5>
                        <span class="font-semibold text-xl text-gray-800">
                            {{ $terlambat['jml'] ?? 0 }}
                        </span>
                    </div>
                    <div class="relative w-auto pl-4 flex-initial">
                        <div
                            class="
                      text-white
                      p-3
                      text-center
                      inline-flex
                      items-center
                      justify-center
                      w-12
                      h-12
                      shadow-lg
                      rounded-full
                      bg-red-500
                    ">
                            <i class="fa fa-running"></i>
                        </div>
                    </div>
                </div>
                <p class="text-sm text-gray-500 mt-4">{!! persenan($terlambat['bl']) !!}</p>
            </div>
        </div>
    </div>
</div>
