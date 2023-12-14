<template>
  <Head>
    <title>{{ title }}</title>
  </Head>

  <!-- Data table -->
  <DataTable :data="data" :url="url" :filters="filters" :actions="actions" />
  <!-- End of Data table -->
</template>

<script>
import DataTable from "../../../Shared/Utility/Table/DataTable";

export default {
  components: {
    DataTable,
  },
  props: {
    title: String,
    data: Object,
    filters: Object,
    url: String,
    actions: Array,
  },
};
</script>
