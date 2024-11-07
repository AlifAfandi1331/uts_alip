@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-body">
            <h3>Data pasien</h3>
            <a href="{{ url('pasien/create') }}">Tambah Pasien</a>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>id Pasien</th>
                        <th>foto</th>
                        <th>Nama</th>
                        <th>Umur</th>
                        <th>Jenis Kelamin</th>
                        <th>Alamat</th>
                        <th>No telfon</th>
                        <th>Tgl Buat</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pasien as $index => $item)
                        <tr>
                            <td>{{ ($pasien->currentPage() - 1) * $pasien->perPage() + $index + 1 }}</td>
                            <td>{{ $item->no_pasien }}</td>
                            <td>
                                @if ($item->foto)
                                    <img src="{{ \Storage::url($item->foto) }}" width="50" />
                                @endif
                            </td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->umur }}</td>
                            <td>{{ $item->jenis_kelamin }}</td>
                            <td>{{ $item->alamat }}</td>
                            <td>{{ $item->nomor_telepon_pasien }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>
                                <a href="/pasien/{{ $item->id }}/edit" class="btn btn-warning btn-sm ml-2">
                                    edit </a>

                                <form action="/pasien/{{ $item->id }}" method="post" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-primary btn-sm ml-2"
                                        onclick="return confirm('Yakin ingin menghapus data?')">Hapus</button>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $pasien->links() !!}
        </div>
    </div>
@endsection
