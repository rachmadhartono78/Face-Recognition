<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Presensi Kedisiplinan Pegawai</h3>
                <p class="text-subtitle text-muted">Halaman untuk Monitoring Kehadiran Pegawai</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        {{-- <li class="breadcrumb-item active" aria-current="page">Presensi</li> --}}
                    </ol>
                </nav>
            </div>
        </div>
    </x-slot>

    <div class="page-content">
        <section class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="#" method="POST">
                            @csrf
                            <div class="row mb-4">
                                <div class="col-md-3 form-group">
                                    <label class="control-label">Jenis presensi pegawai</label>
                                    <select name="type_presence" class="form-control" id="type_presence">
                                        <option value="">-- Pilih --</option>
                                        @foreach ($selectOptions['typePresence']['items'] as $option)
                                            <option value="{{ $option['kd_jenis_presensi'] }}" 
                                                    {{ old('type_presence') == $option['kd_jenis_presensi'] ? 'selected' : '' }}>
                                                {{ $option['jenis_presensi_pegawai'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4 form-group">
                                    <label class="control-label">Unit kerja</label>
                                    <select name="work_unit" class="form-control" id="work_unit">
                                        <option value="">-- Pilih --</option>
                                        @foreach ($selectOptions['workUnit']['items'] as $unit)
                                            <option value="{{ $unit['kd_unit_kerja'] }}" 
                                                    {{ old('work_unit') == $unit['kd_unit_kerja'] ? 'selected' : '' }}>
                                                {{ $unit['nama_unit_kerja'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </form>
                        <!-- Tabs -->
                        <ul class="nav nav-tabs" id="tab-presence" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="year-tab" data-bs-toggle="tab" href="#year" role="tab" aria-controls="year" aria-selected="true">Tahun</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="month-tab" data-bs-toggle="tab" href="#month" role="tab" aria-controls="month" aria-selected="false">Bulan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="day-tab" data-bs-toggle="tab" href="#day" role="tab" aria-controls="day" aria-selected="false">Hari</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="tab-content">
                            <div class="tab-pane fade show active" id="year" role="tabpanel" aria-labelledby="year-tab">
                                <!-- Yearly Presence Table -->
                                @include('presence.yearly', ['dataUnit' => $dataUnit, 'dataTypePresence' => $dataTypePresence, 'pageNumber' => $pageNumber])
                            </div>
                            <div class="tab-pane fade" id="month" role="tabpanel" aria-labelledby="month-tab">
                                <!-- Monthly Presence Table -->
                                @include('presence.monthly', ['dataUnit' => $dataUnit, 'dataTypePresence' => $dataTypePresence])
                            </div>
                            <div class="tab-pane fade" id="day" role="tabpanel" aria-labelledby="day-tab">
                                <!-- Daily Presence Table -->
                                @include('presence.daily', ['dataUnit' => $dataUnit, 'dataTypePresence' => $dataTypePresence])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-app-layout>