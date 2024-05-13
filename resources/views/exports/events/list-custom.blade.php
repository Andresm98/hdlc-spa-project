 <table>
     <tr>
         <th>Nro</th>
         <th>Nombre Evento</th>
         {{-- <th>Descripción</th> --}}
         <th>Tipo</th>
         <th>Fecha de Inicio - Fin</th>
     </tr>
     {{ $count = 1 }}
     @foreach ($data as $event)
         <tr>
             <td>{{ $count++ }}</td>
             <td>{{ $event->name }}</td>
             {{-- <td>{!! $event->name !!}</td> --}}
             <td>
                 @if ($event->type == 1)
                     Comunitario
                 @elseif ($event->type == 2)
                     Extracomunitaria
                 @elseif ($event->type == 3)
                     Internacional
                 @endif
             </td>
             <td>
                 {{ date('Y-m-d', strtotime($event->dates)) }} <br>

                 {{ date('Y-m-d', strtotime($event->datesEnd)) }}
             </td>
         </tr>
     @endforeach

 </table>
