<div class="items">
	<form id="adminForm" name="adminForm" method="post">
        <div role="pagination">
            <div class="pag">
                {{ $categorias->appends(Input::except('page', 'enviar', 'reset'))->links() }}
            </div>
        </div>
        <div style="clear:both;"></div>
        <table id="table-list" class="table tablesorter table-bordered table-striped">
            <thead>
                <tr class="titulo" id="chkrowAll">
                    <th width="1%" class="title">#&nbsp;&nbsp;&nbsp;&nbsp;</th>
                    <th width="1%" align="center" class="title"><input type="checkbox" name="toggle" id="checkall" value="" /></th>
                    <th width="2%" class="title">Editar</th>
                    <th width="40%" class="title"><strong>Categor&iacute;a:</strong></th>
                    <th width="20%" class="title"><strong>G&eacute;nero</strong></th>
                    <th width="10%" class="title"><strong>Total Productos:</strong></th>
                    <th width="10%" class="title"><strong>Orden</strong> <a href="#" class="btn-flat btn-app" onclick="$('#adminForm').attr('action', '{{ url('admin/productos/categorias/save-order') }}'); $('#adminForm').submit();"><i class="fa fa-save"></i> Guardar</a></th>
                    <th width="10%" class="title"><strong>ID</strong></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i=0;
                $k = 0;
                ?>
                @if( $categorias )
                    @foreach($categorias as $cat)
                        <?php
						$i++;
                        ?>
                        <tr id="fila{{ $cat->id }}" class="row{{ $k }}" style="vertical-align:top;">
                            <td nowrap="nowrap">{{ $i+( ($categorias->getCurrentPage()-1)*$categorias->getPerPage() ) }}</td>
                            <td nowrap="nowrap">
                            	<input type="checkbox" name="eliminar[{{ $cat->id }}]" class="checkbox_del" title="Eliminar" />
                            </td>
                            <td align="center">
                                <p><a href="{{ url('admin/productos/categorias/edit/'.$cat->id) }}" class="btn-flat btn-app"><i class="fa fa-edit"></i>&nbsp;Editar</a></p>
                            </td>
                            <td align="left">{{ $cat->nombre }}</td>
                            <td align="left">{{ $cat->tipo }}</td>
                            <td align="center">{{ $cat->total_productos()->total }}</td>
                            <td align="center"><input type="text" style="width:35px; text-align:center" name="order[{{ $cat->id }}]" / value="{{ $cat->ordering }}" /></td>
                            <td align="center">{{ $cat->id }}</td>
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
                {{ $categorias->appends(Input::except('page', 'enviar'))->links() }}
            </div>
        </div>
        <div style="clear:both;"></div>
        <input type="hidden" name="campo" value="{{ Input::get('campo', '') }}" />
        <input type="hidden" name="search" value="{{ Input::get('search', '') }}" />
        <input type="hidden" name="id" id="categoria_id" value="" />
        <input type="hidden" name="url_return" id="url_return" value="{{ url('admin/productos/categorias?page='.$categorias->getCurrentPage() ) }}" />
    </form>
</div>