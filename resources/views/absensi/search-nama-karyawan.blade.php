<ul>
@foreach ($data as $item )
    <li class="search-result" onclick="addToTable(this)">{{ $item->nama_karyawan }}</li>
@endforeach
</ul>