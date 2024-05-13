<?php
use App\Http\Controllers\AddressController;
?>
<table>
    <tr>
        <th>Apellidos</th>
        <th>Nombres</th>
        <th>Libros</th>
        <th>Página</th>
        <th>Correo</th>
        <th>Cédula</th>
        <th>Fecha Nacimiento</th>
        <th>Vocación</th>
        <th>Activa</th>
        <th>Fecha Fallecida</th>
        <th>Fecha Retiro</th>
        <th>Fecha Salida a Otros Países</th>
        <th>Lugar</th>
        <th>Documentos Físicos</th>
        <th>Documentos Digitales</th>
        <th>Caja</th>
        <th>Provincia Nacimiento</th>
        <th>Cantón Nacimiento</th>
        <th>Parroquia Nacimiento</th>
        <th>Observaciones Lugar Nacimiento</th>
    </tr>
    {{ $count = 1 }}
    @foreach ($data as $daughter)
        <tr>
            <td>
                {{ $daughter->lastname }}
            </td>
            <td>
                {{ $daughter->name }}
            </td>
            @if ($daughter->profile)
                <td>
                    @if (count($daughter->profile->profileBooks) > 0)
                        @if (count($daughter->profile->profileBooks) === 1)
                            @foreach ($daughter->profile->profileBooks as $book)
                                {{ $book->book->name }}
                            @endforeach
                        @else
                            @foreach ($daughter->profile->profileBooks as $book)
                                {{ $book->book->name }},
                            @endforeach
                        @endif
                    @else
                        (en blanco)
                    @endif
                </td>
                <td>
                    @if ($daughter->profile->page)
                        {{ $daughter->profile->page }}
                    @else
                        (en blanco)
                    @endif
                </td>
                <td>
                    @if ($daughter->email)
                        {{ $daughter->email }}
                    @else
                        (en blanco)
                    @endif
                </td>
                <td>
                    @if ($daughter->profile->identity_card)
                        {{ $daughter->profile->identity_card }}
                    @else
                        (en blanco)
                    @endif
                </td>
                <td>
                    @if ($daughter->profile->date_birth)
                        {{ date('Y-m-d', strtotime($daughter->profile->date_birth)) }}
                    @else
                        (en blanco)
                    @endif
                </td>
                <td>
                    @if ($daughter->profile->date_vocation)
                        {{ date('Y-m-d', strtotime($daughter->profile->date_vocation)) }}
                    @else
                        (en blanco)
                    @endif
                </td>
                <td>
                    @if ($daughter->profile->status)
                        @if ($daughter->profile->status === 1)
                            SI
                        @else
                            NO
                        @endif
                    @else
                        (en blanco)
                    @endif
                </td>
                <td>
                    @if ($daughter->profile->date_death)
                        {{ date('Y-m-d', strtotime($daughter->profile->date_death)) }}
                    @else
                        (en blanco)
                    @endif
                </td>
                <td>
                    @if ($daughter->profile->date_exit)
                        {{ date('Y-m-d', strtotime($daughter->profile->date_exit)) }}
                    @else
                        (en blanco)
                    @endif
                </td>
                <td>
                    @if ($daughter->profile->date_other_country)
                        {{ date('Y-m-d', strtotime($daughter->profile->date_other_country)) }}
                    @else
                        (en blanco)
                    @endif
                </td>
                <td>
                    @if ($daughter->profile->place_other_country)
                        {{ $daughter->profile->place_other_country }}
                    @else
                        (en blanco)
                    @endif
                </td>
                <td>
                    @if ($daughter->profile->ph_docs)
                        @if ((int) $daughter->profile->ph_docs === 1)
                            Contiene
                        @else
                            No Contiene
                        @endif
                    @else
                        (en blanco)
                    @endif
                </td>
                <td>
                    @if ($daughter->profile->dg_docs)
                        @if ((int) $daughter->profile->dg_docs === 1)
                            Contiene
                        @else
                            No Contiene
                        @endif
                    @else
                        (en blanco)
                    @endif
                </td>
                <td>
                    @if ($daughter->profile->box)
                        {{ $daughter->profile->box }}
                    @else
                        (en blanco)
                    @endif
                </td>
                @if ($daughter->profile->origin)
                    <?php
                    $origin = AddressController::getSaveAddressBtTwo($daughter->profile->origin->political_division_id);
                    ?>
                    <td>
                        @if ($origin['data_province'] !== null)
                            {{ $origin['data_province']->name }}
                        @endif
                    </td>
                    <td>
                        @if ($origin['data_canton'] !== null)
                            {{ $origin['data_canton']->name }}
                        @endif
                    </td>
                    <td>
                        @if ($origin['data_parish'] !== null)
                            {{ $origin['data_parish']->name }}
                        @endif
                    </td>
                    <td>
                        {{ $daughter->profile->origin->address }}
                    </td>
                @endif
            @endif
        </tr>
    @endforeach
</table>
