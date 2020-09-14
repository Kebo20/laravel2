@extends('admin.users.plantilla')


@section('cabecera')
<h3>Actualizar usuario</h3>

@endsection

@section('contenido')
{!! Form::model($user,['action' =>[ 'AdminUserController@update',$user->id ],'method' => 'patch','files'=>'true']) !!}
{{csrf_field()}}

<table>
    <tr>
        <td>{!!Form::label('name', 'Nombre:')!!}</td>
        <td>{!!Form::label('foto', 'Foto actual:')!!}</td>


    </tr>
    <tr>
        <td>{!!Form::text('name', $user->name,['class' => 'form-control','required'=>'required'])!!}

            @error('name')
            <span style="color: red;">{{$message}}</span>
            @enderror
        </td>
        <td rowspan="10"><img src="/images/{{$user->foto? $user->foto->ruta_foto : 'gogazo.png'}}" width="500px" alt="imagen">
        </td>

    </tr>
    <tr>
        <td>{!!Form::label('email', 'Email:')!!}</td>
    </tr>
    <tr>
        <td>{!!Form::email('email', null,['class' => 'form-control','required'=>'required'])!!}

            @error('email')
            <span style="color: red;">{{$message}}</span>
            @enderror
        </td>
        
    </tr>
    <tr>
        <td>{!!Form::label('email_verified_at', 'Verified Email:')!!}</td>
    </tr>
    <tr>
        <td>{!!Form::email('email_verified_at_', null,['class' => 'form-control'])!!}

            @error('email_verified_at')
            <span style="color: red;">{{$message}}</span>
            @enderror
        </td>
    </tr>


    <tr>
        <td>Roles:</td>
    </tr>
    <tr>
        <td>{!!Form::select('role_id', [''=>'Seleccione','1'=>'Administrador','2'=>'Autor','3'=>'Suscriptor'],null,['class' => 'form-control','required'=>'required'])!!}


        </td>
    </tr>
    <tr>
        <td >Foto:</td>
    </tr>
    <tr>
        <td >{!!Form::file('ruta_foto',null,['class' => 'form-control'])!!}
        </td>
    </tr>

    <tr>
        <td><span> </span></td>
    </tr>


    <tr>


        <td colspan='2' align="right"> <br> {!!Form::submit('Guardar',['class'=>'btn btn-primary'])!!}</td>
    </tr>


</table>
{!! Form::close() !!}


@endsection