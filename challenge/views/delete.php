<div class="modal fade" id="deleteModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="POST" class="form-horizontal" id="form_modal_delete">
                <div class="modal-header">
                    <h4 class="modal-title"> </h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="del_modal_id" />
                    <p class="text-center">Are you sure you want to delete this item?</p>
                </div>
                <div class="modal-footer">
                    <div class="container">
                        <div class="row">
                            <div class="col-6">
                                <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="
                                        var backdrop = document.getElementsByClassName('modal-backdrop')[0]; 
                                        console.log(backdrop);
                                        if (backdrop) {
                                            backdrop.classList.remove('modal-backdrop');
                                        }
                                ">
                                    No
                                </button>
                            </div>
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary">Yes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>