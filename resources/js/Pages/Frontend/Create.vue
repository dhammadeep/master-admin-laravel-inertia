<template>
    <Head>
        <title>{{ title }}</title>
    </Head>

    <FormBuilder :fields="fields" :methodName="methodName" :url="url" :downloadUrl="downloadUrl" :importUrl="importUrl" />


     <!--Error Modal Modal-->
  <Transition>
    <ErrorModal
      v-if="$page.props.errors.errorModalHeader"
      @close="$page.props.errors.errorModalHeader = ''"
      :header="$page.props.errors.errorModalHeader"
      :body="$page.props.errors.errorModalBody"
    />
  </Transition>
  <!--End-->
</template>

<script>
import FormBuilder from "../../Shared/Utility/Form/FormBuilder";
import ErrorModal from "../../Shared/Utility/Modal/ErrorModalView";
export default {
    name: "create-example",
    components: {
        FormBuilder,
        ErrorModal,
    },
    props: {
        title: String,
        url: String,
        downloadUrl: String,
        methodName: String,
        importUrl: String,
        fields: Array,
    },
};
</script>
