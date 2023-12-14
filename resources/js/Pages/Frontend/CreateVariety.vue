<template>
  <Head>
    <title>{{ title }}</title>
  </Head>

  <div class="row">
    <div
      class="col-12 col-sm-12 col-md-12 col-lg-12 mb-3"
      :class="importUrl ? 'col-xl-9 col-xxl-9' : 'col-xl-12 col-xxl-12'"
    >
      <div class="formContainer">
        <form enctype="multipart/form-data" @submit.prevent="Submit" novalidate>
          <div
            class="formTitleContainer d-flex justify-content-between align-items-center border-bottom"
          >
            <h5 class="formTitle m-0">Single Insert</h5>
          </div>

          <div class="row">
            <div
              class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-4 mb-4"
              v-for="field of fields"
              :key="field.name"
            >
              <!--If Single Selectbox Required-->
              <RegularSelect
                v-if="field.formComponent == 'RegularSelect'"
                :label="field.label"
                :name="field.name"
                :id="field.name"
                :source="field.source"
                :mount="field.mount"
                :watching="field.watching"
                :validations="field.validations"
                :options="field.options"
                v-model="form[field.name]"
              />

              <!--If SearchSelect Required-->
              <Searchable
                v-else-if="field.formComponent == 'MultiSelect'"
                :label="field.label"
                :name="field.name"
                :id="field.name"
                :source="field.source"
                :mount="field.mount"
                :watching="field.watching"
                :validations="field.validations"
                :options="field.options"
                v-model="form[field.name]"
              />
              <!--End-->

              <!--If InputText Required-->
              <InputText
                v-else-if="field.formComponent == 'InputText'"
                :label="field.label"
                :name="field.name"
                :id="field.name"
                :validations="field.validations"
                v-model="form[field.name]"
              />
              <!--End-->

              <!--If Textarea Required-->
              <Textarea
                v-else-if="field.formComponent == 'Textarea'"
                :label="field.label"
                :name="field.name"
                :id="field.name"
                :validations="field.validations"
                v-model="form[field.name]"
              />
              <!--End-->

              <!--If File Required-->
              <File
                v-else-if="field.formComponent == 'File'"
                :label="field.label"
                :name="field.name"
                :id="field.name"
                :validations="field.validations"
                v-model="form[field.name]"
                @showModal="showModal($event)"
              />
              <!--End-->

              <!--If File With Preview Required-->
              <FileWithPreview
                v-else-if="field.formComponent == 'FileWithPreview'"
                :label="field.label"
                :name="field.name"
                :id="field.name"
                :validations="field.validations"
                v-model="form[field.name]"
              />
              <!--End-->

              <!--If Radio Required-->
              <Radio
                v-else-if="field.formComponent == 'Radio'"
                :label="field.label"
                :name="field.name"
                :id="field.name"
                :validations="field.validations"
                :options="field.options"
                v-model="form[field.name]"
                :checked="field.value"
              />
              <!--End-->
              <template v-else-if="field.formComponent == 'CustomInputText'">
                <template v-if="methodName != undefined">
                  <InputText
                    :if="field.formComponent == 'CustomInputText'"
                    :label="field.label"
                    :name="field.name"
                    :id="field.name"
                    :validations="field.validations"
                    v-model="form[field.name]"
                  />
                </template>
              </template>
              <!--If Checkbox Required-->
              <Checkbox
                :id="field.name"
                :name="field.name"
                :label="field.label"
                :validations="field.validations"
                v-model:checked="form[field.name]"
                v-else-if="field.formComponent == 'Checkbox'"
                :checked="field.value"
              />
              <!--End-->

              <!--If CheckboxGroup Required-->
              <CheckboxGroup
                :id="field.name"
                :name="field.name"
                :label="field.label"
                :source="field.source"
                :options="field.options"
                :validations="field.validations"
                v-model:value="form[field.name]"
                v-else-if="field.formComponent == 'CheckboxGroup'"
              />
              <!--End-->

              <!-- <span v-else>-</span> -->
            </div>
          </div>

          <div v-if="methodName == undefined">
            <div class="row align-items-start">
              <div class="col-12"><h4>Add Varieties</h4></div>
              <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-4">
                <div
                  class="rounded p-3"
                  style="
                    border: var(--bs-border-width) var(--bs-border-style) #565656 !important;
                  "
                >
                  <div class="mb-2">
                    <label for="DynameVarietyName" class="form-label">Variety Name</label>
                    <input
                      type="text"
                      id="DynameVarietyName"
                      class="form-control"
                      v-model="DynameVarietyName"
                    />
                  </div>
                  <div class="mb-2">
                    <label for="DynameVarietyCode" class="form-label">Variety Code</label>
                    <input
                      type="text"
                      class="form-control"
                      id="DynameVarietyCode"
                      v-model="DynameVarietyCode"
                    />
                  </div>
                  <div>
                    <button type="button" @click="checkValue()" class="btn btn-primary">
                      Add
                    </button>
                  </div>
                </div>
              </div>
              <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-4">
                <div class="table-responsive">
                  <table class="table table-bordered table-dark" style="max-width: 500px">
                    <thead>
                      <tr>
                        <th>Variety Name</th>
                        <th>Variety Code</th>
                      </tr>
                    </thead>

                    <tbody>
                      <tr v-for="item of varietyList" :key="item">
                        <td v-html="item.Name"></td>
                        <td v-html="item.VarietyCode"></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <div
            class="formFooterContainer d-flex justify-content-between align-items-center border-top"
          >
            <button type="sbumit" class="btn btn-primary me-2">Submit</button>
            <button type="button" class="btn btn-danger me-2">Reset</button>
          </div>
        </form>
      </div>
    </div>
    <div
      class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3 col-xxl-3 mb-3"
      v-if="importUrl"
    >
      <div class="formContainer">
        <form
          method="POST"
          enctype="multipart/form-data"
          @submit.prevent="SubmitBulkUploadForm"
          novalidate
        >
          <div
            class="formTitleContainer d-flex justify-content-between align-items-center border-bottom"
          >
            <h5 class="formTitle m-0">Bulk Insert</h5>
            <a :href="downloadUrl">
              <button type="button" class="btn btn-primary me-2">
                <i class="fa fa-download"></i>
              </button>
            </a>
          </div>

          <pre>{{ $page.props.errors.importErrorUrl }}</pre>
          <div
            v-if="$page.props.importErrorUrl"
            :class="$page.props.importErrorUrl ? 'is-invalid' : 'valid'"
          >
            <a :href="$page.props.importErrorUrl"> Click here </a>
            To download error sheet
          </div>

          <div class="row">
            <div class="col-12 mb-4">
              <label for="name" class="form-label"
                >Select Excel (.xlsx) file <span class="required-asterisk">*</span></label
              >
              <input
                type="file"
                class="form-control"
                :class="$page.props.errors.name ? 'is-invalid' : 'valid'"
                :value="modelValue"
                accept=".xlsx"
                @input="fileInput($event)"
                placeholder="No file chosen"
                required
              />
              <div
                class="invalid-feedback"
                v-if="$page.props.errors.name"
                v-text="$page.props.errors.name"
              />
            </div>
          </div>
          <div
            class="formFooterContainer d-flex justify-content-between align-items-center border-top"
          >
            <button type="sbumit" class="btn btn-primary me-2">Submit</button>
            <div v-if="message">{{ message }}</div>
            <button type="button" class="btn btn-danger me-2">Reset</button>
          </div>
        </form>
      </div>
    </div>

    <!-- <button @click="showSuccessModal()">Show Success Modal</button>
        <button @click="showErrorModal()">Show Error Modal</button> -->
  </div>

  <!--Popup Modal-->
  <Transition name="bounce">
    <Modal v-if="isModalVisible" @close="closeModal" :src="modalSrc" :type="modalType" />
  </Transition>
  <!--End-->

  <!--Success Modal Modal-->
  <Transition>
    <SuccessModal
      v-if="isSuccessModalVisible"
      @close="closeSuccessModal"
      :header="successModalHeader"
      :body="successModalBody"
    />
  </Transition>

  <!--Error Modal Modal-->
  <Transition>
    <ErrorModal
      v-if="isErrorModalVisible"
      @close="closeErrorModal"
      :header="errorModalHeader"
      :body="errorModalBody"
    />
  </Transition>
  <!--End-->
</template>

<script setup>
import { defineAsyncComponent, reactive, ref } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";

import axios from "axios";
const RegularSelect = defineAsyncComponent(() =>
  import("../../Shared/Utility/Form/Select/Regular")
);
const Searchable = defineAsyncComponent(() =>
  import("../../Shared/Utility/Form/Select/Searchable")
);
const InputText = defineAsyncComponent(() =>
  import("../../Shared/Utility/Form/Input/Text")
);
const Textarea = defineAsyncComponent(() =>
  import("../../Shared/Utility/Form/Text/Textarea")
);
const Radio = defineAsyncComponent(() => import("../../Shared/Utility/Form/Input/Radio"));
const Checkbox = defineAsyncComponent(() =>
  import("../../Shared/Utility/Form/Input/Checkbox")
);
const CheckboxGroup = defineAsyncComponent(() =>
  import("../../Shared/Utility/Form/Input/CheckboxGroup")
);
const File = defineAsyncComponent(() => import("../../Shared/Utility/Form/Input/File"));
const FileWithPreview = defineAsyncComponent(() =>
  import("../../Shared/Utility/Form/Input/FileWithPreview")
);
const BulkInputForm = defineAsyncComponent(() =>
  import("../../Shared/Utility/Form/BulkInputForm")
);
const Modal = defineAsyncComponent(() => import("../../Shared/Utility/Modal/ModalView"));
const SuccessModal = defineAsyncComponent(() =>
  import("../../Shared/Utility/Modal/SuccessModalView")
);
const ErrorModal = defineAsyncComponent(() =>
  import("../../Shared/Utility/Modal/ErrorModalView")
);
console.log(props.fields);
const props = defineProps({
  fields: Array,
  url: String,
  methodName: String,
  downloadUrl: String,
  importUrl: String,
  importErrorUrl: String,
});
let data = { _method: props.methodName };

for (let key in props.fields) {
  let fieldName = props.fields[key].name;
  let fieldValue = props.fields[key].value;
  let fieldType = props.fields[key].type;
  if (fieldType == "String") {
    data[fieldName] = fieldValue != "" ? fieldValue : "";
  } else if (fieldType == "Number") {
    data[fieldName] = fieldValue != "" ? fieldValue : null;
  } else if (fieldType == "Array") {
    data[fieldName] = fieldValue != "" ? fieldValue : [];
  } else if (fieldType == "Boolean") {
    data[fieldName] = fieldValue != "" ? fieldValue : false;
  }
}

let form = useForm(data);

let Submit = () => {
  form.post(props.url, data);
};
//bulk insert form upload
let fileData = {
  name: null,
};

let formBuilder = useForm(fileData);
let SubmitBulkUploadForm = () => {
  formBuilder.post(props.importUrl, fileData);
};

let fileInput = (event) => {
  formBuilder.name = event.target.files[0];
};

const DynameVarietyName = ref("");
const DynameVarietyCode = ref("");
let varietyList = reactive([]);
let checkValue = () => {
  if (DynameVarietyName.value == undefined) {
    DynameVarietyName.value = "";
  }
  if (DynameVarietyCode.value == undefined) {
    DynameVarietyCode.value = "";
  }

  if (DynameVarietyName.value != "" && DynameVarietyCode.value != "") {
    varietyList.push({
      Name: `${DynameVarietyName.value}`,
      VarietyCode: `${DynameVarietyCode.value}`,
    });

    form["Name"] = [...varietyList.map((item) => item.Name)];
    form["VarietyCode"] = [...varietyList.map((item) => item.VarietyCode)];

    DynameVarietyName.value = "";
    DynameVarietyCode.value = "";
  } else if (DynameVarietyName.value != "" && DynameVarietyCode.value == "") {
    alert("Please Enter VarietyCode");
  } else if (DynameVarietyName.value == "" && DynameVarietyCode.value != "") {
    alert("Please Enter Variety Name");
  } else {
    alert("Please Enter Variety Name And VarietyCode");
  }
};
</script>

<script>
export default {
  data() {
    return {
      isModalVisible: false,
      isSuccessModalVisible: false,
      isErrorModalVisible: false,
      modalSrc: "",
      modalType: "",

      //----------------//

      successModalHeader: "",
      successModalBody: "",

      //----------------//

      errorModalHeader: "",
      errorModalBody: "",
    };
  },
  methods: {
    showModal: function (event) {
      this.isModalVisible = true;
      this.modalSrc = event["uploadedFile"];
      this.modalType = event["uploadedFileName"];
    },

    showSuccessModal: function () {
      this.isSuccessModalVisible = true;
      (this.successModalHeader = "successModalHeader"),
        (this.successModalBody = "successModalBody");
    },

    showErrorModal: function () {
      this.isErrorModalVisible = true;
      (this.errorModalHeader = "errorModalHeader"),
        (this.errorModalBody = "errorModalBody");
    },

    closeModal: function () {
      this.isModalVisible = false;
    },
    closeSuccessModal: function () {
      this.isSuccessModalVisible = false;
    },
    closeErrorModal: function () {
      this.isErrorModalVisible = false;
    },
  },
};
</script>
