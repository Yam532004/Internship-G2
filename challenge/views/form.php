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


<?php
                                                    $databaseService = new DatabaseService();
                                                    $conn = $databaseService->getConnection();
                                                    $query = $conn->query("SELECT * FROM users WHERE deleted_at IS NULL order by created_at desc");

                                                    // Loop through each user fetched from the database
                                                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                                        echo "<tr>";
                                                        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                                                        echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                                                        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                                        echo "<td>" . "0" . htmlspecialchars($row['phone_number']) . "</td>";
                                                        echo '<td>
    
 <form method="post" action="../api/is_locked.php" id="lockForm' . $row['id'] . '">
    <div class="form-check form-switch d-flex justify-content-center text-center">
        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked' . $row['id'] . '" name="is_locked" value="1" ' . ($row['is_locked'] ? 'checked' : '') . ' onchange="document.getElementById(\'lockForm' . $row['id'] . '\').submit();">
        <input type="hidden" name="id" value="' . $row['id'] . '" />
    </div>
</form>                                                    
                                                        </td>';
                                                        echo
                                                        '<td class="text-center d-flex">
    <div class="col-3"></div>

    <button type="button" onclick="editModal(' . $row['id'] . ', \'api/get-user.php?id=' . $row['id'] . '\', \'api/edit-user.php\')" title="Edit user" class="btn btn-sm btn-warning col-2 d-flex justify-content-center align-items-center"
                data-toggle="modal" data-target="#editModal">
            <i class="fa fa-pen-to-square"></i>
    </button>

    <button type="button" onclick="deleteModal(' . $row['id'] . ', \'api/delete-user.php\')" title="Are you sure you want to delete this item?" class="btn btn-sm btn-danger col-2 ml-2 d-flex justify-content-center align-items-center" data-toggle="modal" data-target="#deleteModal">
    <i class="fa fa-trash status_btn"></i>
    </button>
</td>';
                                                        echo "</tr>";
                                                    } ?>