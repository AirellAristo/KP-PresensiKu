@extends("admin.karyawan.viewDetail")

@section('dataPresensi')
<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Mulai Cuti</th>
                <th scope="col">Akhir Cuti</th>
                <th scope="col">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <th>{{ $no++ }}.</th>
                    <td>{{ \Carbon\Carbon::parse($item->mulai)->locale('id')->Format('d M Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->akhir)->locale('id')->Format('d M Y') }}</td>
                    <td>{{ $item->keterangan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
