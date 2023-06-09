<script>
    function confirm_modal(delete_url)
    {
        jQuery('#confirm-delete').modal('show', {backdrop: 'static'});
        document.getElementById('delete_link').setAttribute('href' , delete_url);
    }
</script>

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                {{-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> --}}
                <h4 class="modal-title" id="myModalLabel">{{ translate('Confirmation')}}</h4>
            </div>

            <div class="modal-body">
                <p>{{ translate('Delete confirmation message')}}</p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ translate('Cancel')}}</button>
                <a id="delete_link" class="btn btn-danger btn-ok">{{ translate('Delete')}}</a>
            </div>
        </div>
    </div>
</div>
