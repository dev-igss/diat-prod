<br>
<br>
<br>
<br>
<br>
<table>
    <thead>
        <tr>
            <td><strong> FECHA SOLICITUD </strong></td>
            <td><strong> JORNADA </strong></td>
            <td><strong> SERVICIO </strong></td>
            <td><strong> DIETAS SOLICITADAS </strong></td>
            <td><strong> DIETAS SERVIDAS </strong></td>
            <td><strong> ESTADO </strong></td>
        </tr>
    </thead>
    <tbody>
        @foreach($diet_requests as $dr)
            <tr>                
                <td>{{ $dr->created_at }}</td>
                <td>{{ $dr->journey->name }}</td>
                <td>{{ $dr->service->name }}</td>
                <td>{{ $dr->total_diets}}</td>
                <td>{{ $dr->diets_served}}</td>
                <td>{{ getDietStatusArray(null, $dr->status) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>