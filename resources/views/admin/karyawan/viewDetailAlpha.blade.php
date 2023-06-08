@extends("admin.karyawan.viewDetail")

@section('dataPresensi')
<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <th>{{ $no++ }}.</th>
                    <td>{{ \Carbon\Carbon::parse($item->created_at)->locale('id')->isoFormat('LLL') }}</td>
                    <td>{{ $item->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
