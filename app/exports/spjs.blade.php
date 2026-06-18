<table>
    <thead>
        <tr>
            <th>Nama</th>
            <th>No Kad Pintar</th>
            <th>Kod SJ</th>
            <th>No Telefon</th>
            <th>No Mobile</th>
            <th>Emel</th>
            <th>Jawatan</th>
            <th>Jantina</th>
        </tr>
    </thead>
    <tbody>
        @foreach($spjs as $spj)
            <tr>
                <td>{{ $spj->nama }}</td>
                <td>{{ $spj->noKadPintar }}</td>
                <td>{{ $spj->kodSJ }}</td>
                <td>{{ $spj->noTelefon }}</td>
                <td>{{ $spj->noMobile }}</td>
                <td>{{ $spj->emel }}</td>
                <td>{{ $spj->jawatan }}</td>
                <td>{{ $spj->jantina }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
