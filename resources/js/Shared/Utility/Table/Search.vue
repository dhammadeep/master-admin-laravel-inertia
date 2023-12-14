<template>
  <div class="searchForm col p-0">
    <div class="input-group">
      <select class="form-select" v-model="field">
        <option
          v-for="column of options"
          :key="'search_' + column.searchable"
          :value="column.searchable"
        >
          {{ column.label }}
        </option>
      </select>
      <input
        class="form-control"
        type="search"
        v-model="search"
        placeholder="Search here..."
      />
      <Link :href="props.url" class="btn btn-primary">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          height="21"
          viewBox="0 0 21 21"
          width="21"
        >
          <g
            fill="none"
            fill-rule="evenodd"
            stroke="currentColor"
            stroke-linecap="round"
            stroke-linejoin="round"
            transform="matrix(0 1 1 0 2.5 2.5)"
          >
            <path
              d="m3.98652376 1.07807068c-2.38377179 1.38514556-3.98652376 3.96636605-3.98652376 6.92192932 0 4.418278 3.581722 8 8 8s8-3.581722 8-8-3.581722-8-8-8"
            />
            <path d="m4 1v4h-4" transform="matrix(1 0 0 -1 0 6)" />
          </g>
        </svg>
      </Link>
    </div>
  </div>
</template>

<script setup>
import { ref, watch, onMounted } from "vue";
import { Inertia } from "@inertiajs/inertia";
import debounce from "lodash/debounce";

let props = defineProps({
  columns: Array,
  url: String,
  filters: Object,
});

let search = ref(props.filters.search);
let field = ref(props.filters.on);

let options = props.columns.filter(isSearchable);

function isSearchable(data) {
  return data.searchable != undefined && data.searchable != false;
}

watch(
  [search, field],
  debounce((newData, oldData) => {
    let search = newData[0];
    let field = newData[1];
    if (search != undefined && field != undefined) {
      Inertia.get(
        props.url,
        {
          search: search,
          on: field,
        },
        {
          preserveState: true,
          replace: true,
        }
      );
    }
  }, 500)
);
</script>
