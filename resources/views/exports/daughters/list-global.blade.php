<table>
    <tr>
        <th>Apellidos</th>
        <th>Nombres</th>
        <th>Libro</th>
        <th>Página</th>
        <th>Vocación</th>
        <th>Activa</th>
        <th>Fecha Fallecida</th>
        <th>Fecha Retiro</th>
        <th>Fecha Salida a Otros Países</th>
        <th>Lugar</th>
        <th>Caja</th>
        <th>Documentos Físicos</th>
        <th>Documentos Digitales</th>

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
                    @if ($daughter->profile->book)
                        {{ $daughter->profile->book->name }}
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
                    @if ($daughter->profile->box)
                        {{ $daughter->profile->box }}
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
            @endif

        </tr>
    @endforeach

</table>
