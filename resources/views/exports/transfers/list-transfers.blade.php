<?php
use App\Http\Controllers\Secretary\Daughter\TransferController;
?>
<table>
    <tr>
        <th>Nro</th>
        <th>Hermana</th>
        <th>Motivo del permiso</th>
        <th>Fecha de Inicio</th>
        <th>Fecha de Salida y Estado</th>
        <th>Comunidad Anterior</th>
        <th>Comunidad de Destino</th>
    </tr>
    {{ $count = 1 }}
    @foreach ($data as $transfer)
        <tr>
            <td>{{ $count++ }}</td>
            <td>
                {{ $transfer->profile->user->name }}<br>
                {{ $transfer->profile->user->lastname }}<br>
                {{ date('Y-m-d', strtotime($transfer->profile->date_birth)) }}<br>
                @if ($transfer->profile->date_vocation !== null)
                    {{ date('Y-m-d', strtotime($transfer->profile->date_vocation)) }}<br>
                @endif
                @if ($transfer->profile->date_vote != null)
                    {{ date('Y-m-d', strtotime($transfer->profile->date_vote)) }}<br>
                @endif
            </td>
            <td>{{ $transfer->transfer_reason }}</td>
            <td>{{ date('Y-m-d', strtotime($transfer->transfer_date_adission)) }}</td>
            <td>
                @if ($transfer->transfer_date_relocated)
                    {{ date('Y-m-d', strtotime($transfer->transfer_date_relocated)) }}
                @endif
                <br>
                @if ($transfer->status == 1)
                    Activo
                @else
                    Historial
                @endif
                <br>
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

        </tr>
    @endforeach

</table>
