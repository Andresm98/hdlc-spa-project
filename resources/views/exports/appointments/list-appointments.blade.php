<?php
use App\Http\Controllers\Secretary\Transfer\TransferGlobalController;
?>
<table>
    <tr>
        <th>Nro</th>
        <th>Comunidad</th>
        <th>Nombres</th>
        <th>Apellidos</th>
        <th>Fecha Nacimiento</th>
        <th>Fecha Vocación</th>
        {{-- <th>Fecha Votos</th> --}}
        <th>Nombramiento</th>
        <th>Fechas Nombramiento</th>
    </tr>
    {{ $count = 1 }}
    @foreach ($data as $appointment)
        <tr>
            <td>{{ $count++ }}</td>
            <td>
                @if ($appointment->community != null)
                    {{ $appointment->community->comm_name }}
                @endif
            </td>
            <td> {{ $appointment->profile->user->name }}</td>
            <td> {{ $appointment->profile->user->lastname }}</td>
            <td>
                {{ date('Y-m-d', strtotime($appointment->profile->date_birth)) }}<br>

            </td>
            <td>
                @if ($appointment->profile->date_vocation != null)
                    {{ date('Y-m-d', strtotime($appointment->profile->date_vocation)) }}<br>
                @endif
            </td>
            {{-- <td width="10%">
                @if ($appointment->profile->date_vote != null)
                    {{ date('Y-m-d', strtotime($appointment->profile->date_vote)) }}<br>
                @endif
            </td> --}}
            <td>{{ $appointment->appointment_level->name }}</td>
            <td>{{ date('Y-m-d', strtotime($appointment->date_appointment)) }}
                @if ($appointment->date_end_appointment != null)
                    -
                    {{ date('Y-m-d', strtotime($appointment->date_end_appointment)) }}
                @endif
            </td>

        </tr>
    @endforeach

</table>
