@extends('admin')

@section('main-content')

    <data-table col="col-md-8" title="Usuarios" example="example1" color="box-warning">
        <template slot="header">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Usuario</th>
                <th>Nivel</th>
                <th></th>
            </tr>
        </template>

        <template slot="body">
            @foreach($users as $row)
              <tr>
                  <td>
                      {{ $row->id }}
                  </td>
                  <td>{{ $row->name }}</td>
                  <td>{{ $row->email }}</td>
                  <td>{{ $row->level }}</td>
                  <td>
                      <a href="{{ route('user.edit', ['id' => $row->id])}}">
                          <i class="fa fa-edit"></i>
                      </a>
                  </td>
              </tr>
            @endforeach
        </template>
    </data-table>

@endsection
