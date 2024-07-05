<div class="modal fade" id="deleteModal">
    <div class="modal-dialog">
        <div class="modal-content">
            {!! Form::open(array('url' => "", 'class' => 'form-horizontal', 'id' => 'form_modal_delete')) !!}
            <div class="modal-header">
                <h4 class="modal-title">{{ trans('common.notification') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" id="del_modal_id" />
                <p>{{trans('common.confirm_delete')}}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">{{trans('common.no')}}</button>
                <button type="submit" class="btn btn-primary">{{trans('common.yes')}}</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>


<a href="javascript:;" onclick="deleteModal('{{$row->id}}', '/admin/rooms/delete')" title="{{trans('common.delete')}}" class="btn btn-danger"><i class="fa fa-trash"></i></a>

<script>
    var root = "http://localhost:3000/";

    function deleteModal(e, t) {
        $("#form_modal_delete").attr("action", root + t), $("#del_modal_id").val(e), $("#deleteModal").modal("show")
    }
</script>