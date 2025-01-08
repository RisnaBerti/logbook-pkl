{{-- 
    Time Picker Component 
    Penggunaan

    <x-input.timepicker 
        name1="waktu_mulai" 
        name2="waktu_selesai" 
        id1="timepicker2" 
        :value1="old('waktu_mulai', '08:00')" 
        :value2="old('waktu_selesai', '16:00')" 
        placeholder="Pilih Rentang Waktu" 
        singleTimePicker="false" 
    />

    <x-input.timepicker 
        name1="jam_kerja" 
        id1="timepicker1" 
        :value1="old('jam_kerja', '09:00')" 
        placeholder="Pilih Jam" 
        singleTimePicker="true" 
    />

--}}{{-- resources/views/components/input/timepicker.blade.php --}}

@props([
    'name1',
    'name2' => null,
    'id1' => null,
    'id2' => null,
    'value1' => null,
    'value2' => null,
    'placeholder' => '',
    'timeFormat' => 'H:i', // Format waktu
    'singleTimePicker' => false, // Single picker atau range
    'class' => '',
])

@php
    $id1 = $id1 ?? $name1;
    $id2 = $id2 ?? $name2;
    $value1 = $value1 ?? now()->format('H:i');
    $value2 = $value2 ?? now()->format('H:i');
@endphp

<div class="timepicker-wrapper">
    {{-- Input utama untuk waktu --}}
    <input type="text" id="{{ $id1 }}" placeholder="{{ $placeholder }}"
        class="form-control {{ $class }}" {{ $attributes }} />

    {{-- Hidden input untuk menyimpan nilai waktu --}}
    <input type="hidden" name="{{ $name1 }}" value="{{ $value1 }}">

    @if (!$singleTimePicker)
        <input type="hidden" name="{{ $name2 }}" value="{{ $value2 }}">
    @endif
</div>

@once
    @push('css')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    @endpush
    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    @endpush
@endonce

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const singleTimePicker = {{ $singleTimePicker ? 'true' : 'false' }};
        const timeFormat = "{{ $timeFormat }}";

        // Dapatkan referensi ke hidden input
        const hiddenInput = document.querySelector('input[name="{{ $name1 }}"]');

        const options = {
            enableTime: true,
            noCalendar: true,
            dateFormat: timeFormat,
            time_24hr: true,
            defaultDate: singleTimePicker ? "{{ $value1 }}" : ["{{ $value1 }}",
                "{{ $value2 }}"
            ],
            // Tambahkan onChange event
            onChange: function(selectedDates, dateStr) {
                // Update nilai hidden input
                hiddenInput.value = dateStr;
            }
        };

        if (!singleTimePicker) {
            options.mode = "range";
        }

        flatpickr("#{{ $id1 }}", options);
    });
</script>
