@extends ('layouts.app')

@section ('content')

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>
                <div class="links">
        		    <ul>
                        <li>
                            <a href="{{url('sesion')}}">Sesión</a>
                        </li>
                        <li>
                            <a href="{{url('puntoAgenda')}}">Puntos de agenda</a>
                        </li>
                        <li>
                            <a href="{{url('indexAdmin')}}">Administrar puntos de agenda</a>
                        </li>
        		    </ul>
                </div>
            </div>
@endsection

