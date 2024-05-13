<?php
use App\Http\Controllers\Secretary\Daughter\TransferController;
?>
<table>
    <tr>
        <th>Nro</th>
        <th>NOMBRES Y APELLIDOS</th>
        <th>AÑO NAC.</th>
        <th>FECHA VOCACIÓN</th>
        <th>PROCEDE DE:</th>
        <th>VA A:</th>
        <th>MOTIVO DEL CAMBIO</th>
        <th>FECHA DEL CAMBIO</th>
        <th>FECHA DE INSTALACIÓN</th>
    </tr>
    {{ $count = 1 }}
    @foreach ($data as $transfer)
        <tr>
            <td>{{ $count++ }}</td>
            <td>
                {{ $transfer->profile->user->name }}<br>
                {{ $transfer->profile->user->lastname }}<br>
            </td>
            <td>
                {{ date('Y', strtotime($transfer->profile->date_birth)) }}
            </td>
            <td>
                @if ($transfer->profile->date_vocation !== null)
                    {{ date('Y-m-d', strtotime($transfer->profile->date_vocation)) }}
                @endif
            </td>
            <td>
                <?php
                $lastTransfer = TransferController::theLastTransfer($transfer->profile->user->id, $transfer->id);
                ?>
                @if ($lastTransfer)
                    {{ $lastTransfer->community->comm_name }}
                @endif

            </td>
            <td>{{ $transfer->community->comm_name }}</td>

            <td>
                {{ $transfer->transfer_reason }}
            </td>
            <td>{{ date('Y-m-d', strtotime($transfer->transfer_date_adission)) }}</td>
            <td>

            </td>
        </tr>
    @endforeach

</table>
