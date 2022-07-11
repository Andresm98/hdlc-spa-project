<?php
use App\Http\Controllers\Secretary\Community\CommunityDaughterController;
$count = 1;
?>

@foreach ($data as $community)
    <table>
        <tr>
            <th>Nro</th>
            @if ($community->comm_level == 1)
                <th>Nombre Comunidad</th>
            @else
                <th>Nombre Obra</th>
            @endif
            <th>Pastoral</th>
            <th>Fechas Actividad</th>
            {{-- <th>Fecha de Nacimiento</th> --}}
        </tr>
        <tr>
            <td>{{ $count++ }}</td>
            <td>{{ $community->comm_name }}</td>
            <td>{{ $community->pastoral->name }}</td>
            <td>
                @if ($community->comm_status == 1)
                    Abierta <br>
                    ({{ date('Y-m-d', strtotime($community->date_fndt_comm)) }})
                    - Presente
                @else
                    Cerrada <br>
                    ({{ date('Y-m-d', strtotime($community->date_fndt_comm)) }}) hasta
                    ({{ date('Y-m-d', strtotime($community->date_close)) }})
                @endif
            </td>
            {{-- <td>Pendiente</td> --}}
        </tr>
    </table>

    <?php
    $listDaughters = CommunityDaughterController::report($community->id);
    ?>
    @if (count($listDaughters) > 0)
        <table>
            <tr>
                <th>Nro</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Nombre en Comunidad</th>
                <th>Fechas</th>
                <th>Nombramiento</th>
            </tr>
            {{ $countTwo = 1 }}
            @foreach ($listDaughters as $daughter)
                <tr>
                    <td>{{ $countTwo++ }}</td>
                    <td>
                        {{ $daughter->profile->user->name }}
                    </td>
                    <td>
                        {{ $daughter->profile->user->lastname }}
                    </td>
                    <td>
                        {{ $daughter->profile->user->fullnamecomm }}
                    </td>
                    <td>
                        F.Nacimiento:
                        {{ date('Y-m-d', strtotime($daughter->profile->date_birth)) }}<br>
                        @if ($daughter->profile->date_vocation != null)
                            F.Vocación:
                            {{ date('Y-m-d', strtotime($daughter->profile->date_vocation)) }}<br>
                        @endif
                        @if ($daughter->profile->date_vote != null)
                            F.Votos: {{ date('Y-m-d', strtotime($daughter->profile->date_vote)) }}<br>
                        @endif

                    </td>
                    <td>
                        @foreach ($daughter->appointments as $appointment)
                            @if ($appointment->status == 1)
                                {{ $appointment->appointment_level->name }}<br>
                            @endif
                        @endforeach
                    </td>

                </tr>
            @endforeach
        </table>
        <br><br>
    @endif
@endforeach
