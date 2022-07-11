<table>
    <tr>
        <th>Nro</th>
        <th>Hermana</th>
        <th>Nombramiento</th>
        <th>Fecha de Inicio y Fin del Nombramiento</th>
        <th>Comunidad en donde cumple funciones</th>
    </tr>
    {{ $count = 1 }}
    @foreach ($data as $appointment)
        <tr>
            <td>{{ $count++ }}</td>
            <td>
                {{ $appointment->profile->user->name }}<br>
                {{ $appointment->profile->user->lastname }}<br>
                {{ date('Y-m-d', strtotime($appointment->profile->date_birth)) }}<br>
                @if ($appointment->profile->date_vocation != null)
                    {{ date('Y-m-d', strtotime($appointment->profile->date_vocation)) }}<br>
                @endif
                @if ($appointment->profile->date_vote != null)
                    {{ date('Y-m-d', strtotime($appointment->profile->date_vote)) }}<br>
                @endif
            </td>
            <td>{{ $appointment->appointment_level->name }}</td>
            <td>{{ date('Y-m-d', strtotime($appointment->date_appointment)) }}
                @if ($appointment->date_end_appointment != null)
                    -
                    {{ date('Y-m-d', strtotime($appointment->date_end_appointment)) }}
                @endif
                <br>
                @if ($appointment->status == 1)
                    Activo
                @else
                    Historial
                @endif
                <br>
            </td>
            <td>
                @if ($appointment->community != null)
                    {{ $appointment->community->comm_name }}
                @endif
            </td>
        </tr>
    @endforeach

</table>
