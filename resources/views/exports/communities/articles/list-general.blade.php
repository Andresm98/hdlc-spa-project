<table>
    <tr>
        <th>Nro</th>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Estado</th>
        <th>Material</th>
        <th>Marca</th>
        <th>Color</th>
        <th>Precio</th>
        <th>Medidas</th>
        <th>Creado en</th>
        {{-- <th>Fecha de Nacimiento</th> --}}
    </tr>
    {{ $count = 1 }}
    @foreach ($data as $article)
        <tr>
            <td>{{ $count++ }}</td>
            <td>
                {{ $article->name }}

            </td>
            <td>
                {!! $article->description !!}
            </td>
            <td>
                @if ($article->status == 1)
                    Malo
                @elseif ($article->status == 2)
                    Regular
                @elseif ($article->status == 3)
                    Bueno
                @elseif ($article->status == 4)
                    Muy bueno
                @elseif ($article->status == 5)
                    Excelente
                @endif
            </td>
            <td>
                @if ($article->material == 1)
                    Madera
                @elseif ($article->material == 2)
                    Tela
                @elseif ($article->material == 3)
                    Plástico
                @elseif ($article->material == 4)
                    Metal
                @elseif ($article->material == 5)
                    Yeso
                @endif
            </td>
            <td>
                {{ $article->brand }}
            </td>
            <td>
                {{ $article->color }}
            </td>
            <td>
                {{ $article->price }}
            </td>
            <td>
                {{ $article->size }}
            </td>
            <td>
                {{ date('Y-m-d', strtotime($article->created_at)) }} </td>
            {{-- <td>Pendiente</td> --}}
        </tr>

        {{-- Hermanas --}}
    @endforeach

</table>
