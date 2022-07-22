<?php
use App\Http\Controllers\Secretary\Community\CommunityDaughterController;
$count = 1;
?>

@foreach ($data as $community)
    <p style="text-align: center;"><strong>{{ $count++ }}. {{ $community->comm_name }}</strong></p>

    <?php
    $listDaughters = CommunityDaughterController::report($community->id);
    ?>
    @if (count($listDaughters) > 0)
        <table>
            <tr>
                <th>Nro</th>
                <th>Apellidos</th>
                <th>Nombres</th>
                <th>Nombre en Comunidad</th>
                <th>Fecha nacimiento</th>
                <th>Fecha vocación</th>
                <th>Fecha del último destino</th>
            </tr>
            {{ $countTwo = 1 }}
            @foreach ($listDaughters as $daughter)
                <tr>
                    <td >{{ $countTwo++ }}</td>
                    <td >
                        {{ $daughter->profile->user->lastname }}
                    </td>
                    <td >
                        {{ $daughter->profile->user->name }}
                    </td>
                    <td >
                        {{ $daughter->profile->user->fullnamecomm }}
                    </td>
                    <td >
                        {{ date('Y-m-d', strtotime($daughter->profile->date_birth)) }}<br>
                    </td>
                    <td >
                        @if ($daughter->profile->date_vocation != null)
                            {{ date('Y-m-d', strtotime($daughter->profile->date_vocation)) }}<br>
                        @endif
                    </td>
                    <td >
                        @if ($daughter->profile->transfers)
                            @foreach ($daughter->profile->transfers as $transfer)
                                @if ($transfer->status == 1)
                                    {{ date('Y-m-d', strtotime($transfer->transfer_date_adission)) }}
                                @endif
                            @endforeach
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
    @endif
@endforeach
