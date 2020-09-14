@extends('admin/users/plantilla')


@section('cabecera')

<h3>Listar usuarios</h3>


@endsection

@section('contenido')

<table class="table table-sm table-responsive-lg table-hover table-bordered text-center">
    <thead class="thead-dark text-center">
        <tr>
            <th>Nombre</th>
            <th>Email</th>
            <th>Rol</th>
            <th>Creado</th>
            <th>Actualizado</th>
            <th>Imagen</th>
            <th colspan="2">Acciones</th>
        </tr>

    </thead>
    @if($users)
    @foreach($users as $user)
    <tr>
        <td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
        <td>{{$user->role->nombre}}</td>
        <td>{{$user->created_at}}</td>
        <td>{{$user->updated_at}}</td>
        <td><img src="/images/{{$user->foto->ruta_foto}}" width="100px" alt="imagen"></td>
        <td> <a class="btn btn-xs btn-success" href="{{route('users.edit',$user->id)}}">Editar</a></td>

        <td>
            {!! Form::open(['action' => ['AdminUserController@destroy', $user->id],'method' => 'delete']) !!}
            {{csrf_field()}}
            {!!Form::submit('Borrar',['class'=>'btn btn-xs btn-danger'])!!}
            {!! Form::close() !!}

        </td>
    </tr>
    @endforeach
    @endif
</table>







@endsection