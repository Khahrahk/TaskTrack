<div class="modal fade" id="create-modal" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel"
     data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Create issue</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="w-100" id="form" method="post" action="">
                <div class="modal-body">
                    @csrf
                    <x-input id="name" name="name" wrapper-class="w-100" label-top label="Name:" autofocus required/>
                    <div class="modal-footer p-0 mt-2" style="border-top: none">
                        <div class="d-flex justify-content-end gap-2">
                            <x-button outline monochrome data-bs-dismiss="modal" label="Cancel"/>
                            <x-button primary disabled id="submit" type="submit" label="Create"/>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
