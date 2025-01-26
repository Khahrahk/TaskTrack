<div class="modal fade" id="update-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Update issue</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="w-100" id="form" method="post" action="">
                <div class="modal-body">
                    @csrf
                    <x-input type="hidden" id="id" name="id"/>
                    <x-input id="name" name="name" wrapper-class="w-100" class="" label-top label="Name:" autofocus required/>
                    <div class="modal-footer p-0 mt-2" style="border-top: none">
                        <div class="d-flex w-100 justify-content-between">
                            <x-button danger disabled id="delete" label="Delete"/>
                            <div class="d-flex justify-content-end gap-2">
                                <x-button outline monochrome data-bs-dismiss="modal" label="Cancel"/>
                                <x-button primary disabled id="submit" type="submit" label="Update"/>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
