<template>
    <form
        method="POST"
        enctype="multipart/form-data"
        @submit="bulkUploadForm.post(importUrl)"
        novalidate
    >
        <div
            class="formTitleContainer d-flex justify-content-between align-items-center border-bottom"
        >
            <h5 class="formTitle m-0">Bulk Insert</h5>
            <a href="export">
                <button type="button" class="btn btn-primary me-2">
                    <i class="fa fa-download"></i>
                </button>
            </a>
        </div>

        <div class="row">
            <div class="col-12 mb-4">
                <!-- <File
                    label="Select Excel file"
                    name="name"
                    id="name"
                    v-model="form[field.name]"
                    @showModal="showModal($event)"
                /> -->
            </div>
        </div>
        <div
            class="formFooterContainer d-flex justify-content-between align-items-center border-top"
        >
            <button type="sbumit" class="btn btn-primary me-2">Submit</button>
            <button type="button" class="btn btn-danger me-2">Reset</button>
        </div>
    </form>
</template>
<script>
const File = defineAsyncComponent(() => import("./Input/File"));
const props = defineProps({
    formBuilder: Object,
});
</script>
