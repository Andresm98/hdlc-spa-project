<?php
use App\Http\Controllers\Secretary\Transfer\TransferGlobalController;
?>
<table>
    <tr>
        <th>Nro</th>
        <th>Hermana</th>
        <th>Fecha del C. Provincial que concedió o renovó el permiso</th>
        <th>Fecha del C. General que concedió o renovó el permiso</th>
        <th>Fecha de Salida y Motivos</th>
        <th>Frecuencia de relaciones con la Comunidad local a la que está vinculada</th>
        <th>Fecha de Regreso (eventual)</th>
    </tr>
    {{ $count = 1 }}
    @foreach ($data as $permit)
        <tr>
            <td>{{ $count++ }}</td>
            <td>
                {{ $permit->profile->user->name }}<br>
                {{ $permit->profile->user->lastname }}<br>
                {{ date('Y-m-d', strtotime($permit->profile->date_birth)) }}<br>
                @if ($permit->profile->date_vocation != null)
                    {{ date('Y-m-d', strtotime($permit->profile->date_vocation)) }}<br>
                @endif
                @if ($permit->profile->date_vote != null)
                    {{ date('Y-m-d', strtotime($permit->profile->date_vote)) }}<br>
                @endif
            </td>
            <td>{{ date('Y-m-d', strtotime($permit->date_province)) }}</td>
            <td>{{ date('Y-m-d', strtotime($permit->date_general)) }}</td>
            <td>
                {{ date('Y-m-d', strtotime($permit->date_out)) }}<br>
                {{ $permit->reason }}<br>
                @if ($permit->status == 1)
                    Activo
                @else
                    Historial
                @endif
                <br>
            </td>
            <td>
                @if ($permit->community)
                    {{ $permit->community->comm_name }}
                @endif
            </td>

            <td>{{ date('Y-m-d', strtotime($permit->date_in)) }}</td>

        </tr>
    @endforeach

</table>
