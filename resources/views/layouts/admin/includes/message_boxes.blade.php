@if(isset($delete) && $delete)
<!-- delete -->
<div class="message-box animated fadeIn" id="message-box-delete">
    <div class="mb-container">
        <div class="mb-middle">
            <div class="mb-title"><span class="fa fa-trash-o"></span> Delete Confirmation</div>
            <div class="mb-content">
                <p>You are going to delete the selected {{ isset($item)? $item : 'Item' }}, Are you sure?</p>
            </div>
            <div class="mb-footer">
                <button class="btn btn-default pull-right mb-control-close">Close</button>
                <button style="margin-right:5px;" class="btn btn-danger pull-right mb-control-action">Delete</button>
            </div>
        </div>
    </div>
</div>
<!-- end delete -->
@endif