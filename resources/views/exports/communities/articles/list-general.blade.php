 <table>
     <tr>
         <th>Nro</th>
         <th>Nombre</th>
         <th>Estado</th>
         <th>Material</th>
         <th>Detalles</th>
         <th>Fechas Actividad</th>
         {{-- <th>Fecha de Nacimiento</th> --}}
     </tr>
     {{ $count = 1 }}
     @foreach ($data as $article)
         <tr>
             <td>{{ $count++ }}</td>
             <td style="text-align: justify;" width="30%">
                 Nombre: {{ $article->name }}
                 <br>
                 Descripción: {!! $article->description !!}
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
                 Marca: {{ $article->brand }} <br>
                 Color: {{ $article->color }} <br>
                 Precio: {{ $article->price }} <br>
                 Medidas: {{ $article->size }} <br>
             </td>
             <td>

                 Creado: ({{ date('Y-m-d', strtotime($article->created_at)) }})
                 <br>
                 Actualizado:({{ date('Y-m-d', strtotime($article->updated_at)) }}) <br>

             </td>
             {{-- <td>Pendiente</td> --}}
         </tr>

         {{-- Hermanas --}}
     @endforeach

 </table>
