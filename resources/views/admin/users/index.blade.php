@extends('admin.template.main')

@section('title', 'Lista de usuarios')

@section('content')

<div class="buttom mt-3">
    <a  href="{{ route('users.create') }}" class="btn btn-info">Registrar nuevo usuario</a>
</div>
<table class="table">
    <thead>
      <tr>
        <th scope="col">#ID</th>
        <th scope="col">Nombre</th>
        <th scope="col">Correo</th>
        <th scope="col">Tipo</th>
        <th scope="col">Acción</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <th scope="row">{{ $user->id }}</th>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @if ($user->type =='admin')
                        <span class="badge badge-pill badge-danger">{{ $user->type }}</span>
                    @else
                        <span class="badge badge-pill badge-success">{{ $user->type }}</span>
                    @endif


                </td>
                <td>
                    <a href="{{ route('users.destroy', $user->id) }}" class="btn btn-danger " onclick="return confirm('Seguro que deseas eliminar al usuario: {{ $user->name }} ?')">
                        {{-- <div class="icon-holder"> --}}
                            <div class="icon">
                                <i class="icofont-ui-delete">

                                </i>
                            </div>
                        {{-- </div> --}}
                    </a>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning" onclick="return confirm('Deseas ediar al usuario: {{ $user->name }} ?')">
                        <div class="icon">
                            <i class="icofont-ui-edit">

                            </i>
                        </div>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
  </table>
  <hr>
  <div class="pagination">
   {!! $users->render() !!} {{-- para que funciones la paginación --}}
  </div>
@endsection
