<div class="items">
	<form id="adminForm" name="adminForm" method="post">
        <div role="pagination">
            <div class="pag">
                {{ $editorial->appends(Input::except('page', 'enviar', 'reset'))->links() }}
            </div>
        </div>
        <div style="clear:both;"></div>
        <table id="table-list" class="table tablesorter table-bordered table-striped">
            <thead>
                <tr class="titulo" id="chkrowAll">
                    <th width="1%" class="title">#&nbsp;&nbsp;&nbsp;&nbsp;</th>
                    <th width="1%" align="center" class="title"><input type="checkbox" name="toggle" class="checkall" value="" /></th>
                    <th width="10%" class="title"><strong>Imagen</strong></th>
                    <th width="2%" class="title">Editar</th>
                    <th width="15%" class="title"><strong>No. Publicacion</strong></th>
                    <th width="40%" class="title"><strong>Título:</strong></th>
                    
                </tr>
            </thead>
            <tbody>
                <?php
                $i=0;
                $k = 0;
                ?>
                @if( $editorial )
                    @foreach($editorial as $value)
                        <?php
						$i++;
                        ?>
                        <tr id="fila{{ $value->id }}" class="row{{ $k }}" style="vertical-align:top;">
                            <td nowrap="nowrap">{{ $i+( ($editorial->getCurrentPage()-1)*$editorial->getPerPage() ) }}</td>
                            <td nowrap="nowrap">
                            	<input type="checkbox" name="eliminar[{{ $value->id }}]" class="checkbox_del" title="Eliminar" />
                            </td>
                            <td align="center">
                            	@if( is_file($value->path.''.$value->archivo) )
                                    <img src="{{ asset($value->path.''.$value->archivo) }}" alt="{{ $value->titulo }}" width="100%;" />
                                @else
                                    <img src="{{ asset('img/thumb_nodisponible.jpg') }}" alt="Sin Imagen" />
                                @endif
                            </td>
                            <td align="center">
                                <p><a href="{{ url('admin/editorial/edit/'.$value->id) }}" class="btn-flat btn-app"><i class="fa fa-edit"></i>&nbsp;Editar</a></p>
                            </td>
                            <td align="left">{{ $value->no_publicacion }}</td>
                            <td align="left">{{ $value->titulo }}</td>
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
                {{ $editorial->appends(Input::except('page', 'enviar'))->links() }}
            </div>
        </div>
        <div style="clear:both;"></div>
        <input type="hidden" name="id" id="producto_id" value="" />
        <input type="hidden" name="url_return" id="url_return" value="{{ url('admin/editorial?page='.$editorial->getCurrentPage() ) }}" />
    </form>
</div>