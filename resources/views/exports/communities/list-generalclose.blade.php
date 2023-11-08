<?php
use App\Http\Controllers\AddressController;
?>
<table>
    <tr>
        <th>Nombre</th>
        <th>Pastoral</th>
        <th>Dirección</th>
        <th>Teléfono</th>
        <th>Correo</th>
        <th>Fechas Fundación</th>
        <th>Fechas Cierre</th>
        {{-- <th>Fecha de Nacimiento</th> --}}
    </tr>
    <?php
    $addressClass = new AddressController();
    $count = 1;
    ?>
    @foreach ($data as $community)
        <tr>
            <td>{{ $community->comm_name }}</td>
            <td>{{ $community->pastoral->name }}</td>
            <td>
                <?php
                $address = $addressClass->getActualAddress($community->address->political_division_id);
                ?>

                {{ $community->address->address }} <br><br>
                {{ $address->get('data_province') }}<br>
                {{ $address->get('data_canton') }}<br>
                {{ $address->get('data_parish') }}<br>
            </td>
            <td>
                @if ($community->comm_phone)
                    {{ $community->comm_phone }}
                @endif
            </td>
            <td>{{ $community->comm_email }}</td>
            <td>
                @if ($community->comm_status == 1)
                    {{ date('Y-m-d', strtotime($community->date_fndt_comm)) }}
                @else
                    {{ date('Y-m-d', strtotime($community->date_fndt_comm)) }}
                @endif
            </td>
            <td>
                @if ($community->comm_status == 1)
                    Presente
                @else
                    {{ date('Y-m-d', strtotime($community->date_close)) }}
                @endif
            </td>
        </tr>

        {{-- Hermanas --}}
    @endforeach

</table>
