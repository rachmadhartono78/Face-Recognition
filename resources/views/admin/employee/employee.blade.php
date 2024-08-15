<x-app-layout>
    <x-slot name="header">
        <div class="row">
            {{-- <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Karyawan</h3>
                <p class="text-subtitle text-muted">Data Karyawan UII.</p>
            </div> --}}
            <div class="col-12 col-md-6 order-md-2 order-first">
                {{-- <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Data Karyawan</li>
                    </ol>
                </nav> --}}
            </div>
        </div>
    </x-slot>

    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <title>
            Data Karyawan
        </title>
        <script src="https://cdn.tailwindcss.com">
        </script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&amp;display=swap"
            rel="stylesheet" />
        <style>
            body {
                font-family: 'Inter', sans-serif;
            }
        </style>
    </head>

    {{-- <body class="bg-gray-100">
        <div class="container mx-auto px-4 py-6">
            <h1 class="text-3xl font-semibold mb-6">
                Data Karyawan
            </h1>
            <div class="bg-white shadow rounded-lg p-6 mb-6">
                <div class="flex justify-between items-center mb-6">
                    <div class="flex space-x-2">
                        <div class="relative">
                            <select
                                class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="grid-state">
                                <option>
                                    Semua Jabatan
                                </option>
                            </select>
                            <div
                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="fill-current h-4 w-4" viewbox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M5.516 7.548c0.436-0.446 1.043-0.481 1.576 0l3.908 3.747 3.908-3.747c0.533-0.481 1.141-0.446 1.576 0 0.436 0.481 0.408 1.182 0 1.664l-4.695 4.502c-0.408 0.392-1.072 0.392-1.48 0l-4.695-4.502c-0.408-0.481-0.436-1.182 0-1.664z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                        <input
                            class="w-full bg-gray-200 text-gray-700 border border-gray-200 py-3 px-4 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="search" placeholder="Cari Karyawan..." type="text" />
                    </div>
                    <div>
                        <button
                            class="text-white bg-blue-500 hover:bg-blue-700 font-medium py-2 px-4 rounded inline-flex items-center">
                            <i class="fas fa-search mr-2">
                            </i>
                            <span>
                                Search
                            </span>
                        </button>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Nama Karyawan
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Jabatan
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Email
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Tempat Lahir
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Tanggal Lahir
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Nomor HP
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Jabatan
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Repeat for each employee -->
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 w-10 h-10">
                                            <img alt="Profile picture of Junaeid Darton"
                                                class="w-full h-full rounded-full" height="100"
                                                src="https://oaidalleapiprodscus.blob.core.windows.net/private/org-CF8V0gH5lBl5PKo9YSBvI1ST/user-3GHcjvVY6DM1Y8bNrH2IgLWW/img-FYBB3uclIvqpbfkjc84EXEw7.png?st=2024-01-11T00%3A22%3A32Z&amp;se=2024-01-11T02%3A22%3A32Z&amp;sp=r&amp;sv=2021-08-06&amp;sr=b&amp;rscd=inline&amp;rsct=image/png&amp;skoid=6aaadede-4fb3-4698-a8f6-684d7786b067&amp;sktid=a48cca56-e6da-484e-a814-9c849652bcb3&amp;skt=2024-01-10T02%3A24%3A54Z&amp;ske=2024-01-11T02%3A24%3A54Z&amp;sks=b&amp;skv=2021-08-06&amp;sig=SFeUuGlpjAucNMxBntnA2RVGHfD8dSReOc2oROi4fqg%3D"
                                                width="100" />
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                Junaeid Darton
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        Developer
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        ckctm12@gmail.com
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        DKI Jakarta
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        20/06/1988
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        +62 813 1234 5678
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        Developer
                                    </p>
                                </td>
                            </tr>
                            <!-- Repeat for each employee -->
                        </tbody>
                    </table>
                </div>
                <div class="px-5 py-5 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between">
                    <div class="inline-flex mt-2 xs:mt-0">
                        <button
                            class="text-sm text-indigo-50 transition duration-150 hover:bg-indigo-600 bg-indigo-500 font-semibold py-2 px-4 rounded-l">
                            Prev
                        </button>
                        <button
                            class="text-sm text-indigo-50 transition duration-150 hover:bg-indigo-600 bg-indigo-500 font-semibold py-2 px-4 rounded-r">
                            Next
                        </button>
                    </div>
                    <div class="inline-flex mt-2 xs:mt-0">
                        <button
                            class="text-sm text-gray-700 transition duration-150 hover:bg-gray-200 bg-white font-semibold py-2 px-4 rounded-l">
                            1
                        </button>
                        <button
                            class="text-sm text-gray-700 transition duration-150 hover:bg-gray-200 bg-white font-semibold py-2 px-4">
                            2
                        </button>
                        <button class="text-sm text-gray-500 transition duration-150 bg-white font-semibold py-2 px-4">
                            ...
                        </button>
                        <button
                            class="text-sm text-gray-700 transition duration-150 hover:bg-gray-200 bg-white font-semibold py-2 px-4 rounded-r">
                            10
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </body> --}}
    <body class="bg-gray-100">
        <div class="container mx-auto px-4 py-6">
            <h1 class="text-3xl font-semibold mb-6">
                Data Karyawan
            </h1>
            <div class="bg-white shadow rounded-lg p-6 mb-6">
                <!-- ... (Bagian Pencarian dan Filter) ... -->

                <div class="overflow-x-auto">
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Nama Karyawan
                                </th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Jabatan
                                </th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Email
                                </th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Tempat Lahir
                                </th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Tanggal Lahir
                                </th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Nomor HP
                                </th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Jabatan
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Perulangan untuk setiap karyawan -->
                            @foreach ($employee as $employee)
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <div class="flex items-center">
                                        {{-- <div class="flex-shrink-0 w-10 h-10">
                                            <img alt="Profile picture of {{ $employee->nama_karyawan }}"
                                                class="w-full h-full rounded-full" height="100"
                                                src="{{ $employee->profile_picture_url }}" width="100" />
                                        </div> --}}
                                        <div class="ml-3">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                {{ $employee->nama_karyawan }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{ $employee->jabatan }}
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{ $employee->email }}
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{ $employee->tempat_lahir }}
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{ $employee->tanggal_lahir }}
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{ $employee->nomor_hp }}
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{ $employee->jabatan }}
                                    </p>
                                </td>
                            </tr>
                            @endforeach
                            <!-- Akhir perulangan -->
                        </tbody>
                    </table>
                </div>

                <!-- ... (Paging Section) ... -->

            </div>
        </div>
    </body>


    </html>
</x-app-layout>
