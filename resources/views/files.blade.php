@extends('admin')

@section('main-content')

    <row-woc col="col-md-12">
        <solid-box title="Subir diseño" color="box-info">
            {!! Form::open([
                'method' => 'POST', 'route' => 'design.upload', 'enctype' => 'multipart/form-data']) !!}
                {!! Field::text('name') !!}
                <input type="file" name="file" required>
                <input type="hidden" name="type" value="{{ $type }}">
                {!! Form::submit('Agregar', ['class' => 'btn btn-info pull-right']) !!}
            {!! Form::close() !!}
        </solid-box>
    </row-woc>

    <div class="row">
        <div class="col-md-4">
            <data-table-com title="Existentes"
                example="example6" color="box-info">
                <template slot="header">
                    <tr>
                        <th>Nombre</th>
                        <th>Ver</th>
                    </tr>
                </template>

                <template slot="body">
                    @foreach($designs as $design)
                      <tr>
                          <td>{{ substr($design, 15) }}</td>
                          <td>
                              <a href="{{ Storage::url($design) }}">
                                  <i class="fa fa-eye" aria-hidden="true"></i>
                              </a>
                          </td>
                      </tr>
                    @endforeach
                </template>
            </data-table-com>
        </div>

        <div class="col-md-4">
            <data-table-com title="Temporales/nuevos"
                example="example6" color="box-default">
                <template slot="header">
                    <tr>
                        <th>Nombre</th>
                        <th>Ver</th>
                    </tr>
                </template>

                <template slot="body">
                    @foreach($temps as $temp)
                      <tr>
                          <td>
                              {{ substr($temp, 12) }}
                          </td>
                          <td>
                              <a href="{{ Storage::url($temp) }}">
                                  <i class="fa fa-eye" aria-hidden="true"></i>
                              </a>
                          </td>
                          <!--td>
                              <a href="{ { route('design.delete', ['img' => substr($temp, 12)]) }}"
                                  title="ELIMINAR">
                                  <i class="fa fa-trash-o" aria-hidden="true"></i>
                              </a>
                          </td-->
                      </tr>
                    @endforeach
                </template>
            </data-table-com>
        </div>
    </div>
@endsection
