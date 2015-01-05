<div class="items">
	<form id="adminForm" name="adminForm" method="post">
        <div role="pagination">
            <div class="pag">
                {{ $proyectos->appends(Input::except('page', 'enviar', 'reset'))->links() }}
            </div>
        </div>
        <div style="clear:both;"></div>
        <table id="table-list" class="table tablesorter table-bordered table-striped">
            <thead>
                <tr class="titulo" id="chkrowAll">
                    <th width="1%" class="title">#&nbsp;&nbsp;&nbsp;&nbsp;</th>
                    <th width="1%" align="center" class="title"><input type="checkbox" name="toggle" id="checkall" value="" /></th>
                    <th width="10%" class="title"><strong>Imagen</strong></th>
                    <th width="2%" class="title">Editar</th>
                    <th width="20%" class="title"><strong>Título:</strong></th>
                    <th width="13%" class="title"><strong>Categor&iacute;as:</strong></th>
                    <th width="10%" class="title"><strong>Arquitectura:</strong></th>
                    <th width="10%" class="title"><strong>Locación:</strong></th>
                    <th width="10%" class="title"><strong>Cliente:</strong></th>
                    <th width="10%" class="title" nowrap="nowrap"><strong>Status:</strong></th>
                    <th width="5%" class="title"><strong>Asociado</strong></th>
                    <th width="5%" class="title"><strong>ID</strong></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i=0;
                $k = 0;
                ?>
                @if( $proyectos )
                    @foreach($proyectos as $value)
                        <?php
						$i++;
						$imagen = $value->imagen;
                        ?>
                        <tr id="fila{{ $value->id }}" class="row{{ $k }}" style="vertical-align:top;">
                            <td nowrap="nowrap">{{ $i+( ($proyectos->getCurrentPage()-1)*$proyectos->getPerPage() ) }}</td>
                            <td nowrap="nowrap">
                            	<input type="checkbox" name="eliminar[{{ $value->id }}]" class="checkbox_del" title="Eliminar" />
                            </td>
                            <td align="center">
                            	@if( isset($imagen) )
                                	@if( is_file($imagen->path.'thumb_'.$imagen->archivo) )
                                    	<img src="{{ asset($imagen->path.'thumb_'.$imagen->archivo) }}" alt="{{ $value->modelo }}" />
                                    @else
                                    	<img src="{{ asset('img/thumb_nodisponible.jpg') }}" alt="Sin Imagen" />
                                    @endif
                                @else
	                            	<img src="{{ asset('img/thumb_nodisponible.jpg') }}" alt="Sin Imagen" />
                                @endif
                            </td>
                            <td align="center">
                                <p><a href="{{ url('admin/proyectos/edit/'.$value->id) }}" class="btn-flat btn-app"><i class="fa fa-edit"></i>&nbsp;Editar</a></p>
                            </td>
                            <td align="left">{{ $value->titulo }}</td>
                            <td align="left">@foreach($value->categorias as $cat) <p>{{ $cat->nombre }}</p> @endforeach</td>
                            <td nowrap="nowrap">{{ $value->arquitectura}}</td>
                            <td nowrap="nowrap">{{ $value->locacion}}</td>
                            <td nowrap="nowrap">{{ $value->cliente }}</td>
                            <td nowrap="nowrap">{{ $value->status }}</td>
                            <td nowrap="nowrap">{{ $value->asociado }}</td>
                            <td>{{ $value->id }}</td>
                        </tr>
                        <?php $k = 1 - $k; ?>
                    @endforeach
                @else
                    <h2><strong>No se encontraron Registros</strong></h2>
                @endif
            </tbody>
            <tfoot>
                
            </tfoot>
        </table>
        <div role="pagination">
            <div class="pag">
                {{ $proyectos->appends(Input::except('page', 'enviar'))->links() }}
            </div>
        </div>
        <div style="clear:both;"></div>
        <input type="hidden" name="id" id="producto_id" value="" />
        <input type="hidden" name="url_return" id="url_return" value="{{ url('admin/proyectos?page='.$proyectos->getCurrentPage() ) }}" />
    </form>
</div>