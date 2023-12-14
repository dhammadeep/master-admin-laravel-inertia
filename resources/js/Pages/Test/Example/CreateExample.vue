<template>
  <Head>
    <title>{{ title }}</title>
  </Head>

  <FormBuilder :fields="fields" :methodName="methodName" :url="url" :downloadUrl="downloadUrl" :importUrl="importUrl" />
</template>

<script>
import FormBuilder from "../../../Shared/Utility/Form/FormBuilder";

export default {
  name: "create-example",
  components: {
    FormBuilder,
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
